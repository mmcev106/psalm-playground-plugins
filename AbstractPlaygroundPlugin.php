<?php namespace mmcev106\PsalmPlaygroundPlugin;

use Psalm\Plugin\EventHandler\Event\AfterAnalysisEvent;
use Psalm\Plugin\EventHandler\Event\AfterClassLikeExistenceCheckEvent;
use Psalm\Plugin\EventHandler\Event\AfterCodebasePopulatedEvent;
use Psalm\Plugin\EventHandler\Event\AfterFileAnalysisEvent;
use Psalm\Plugin\EventHandler\Event\BeforeFileAnalysisEvent;

require_once 'vendor/autoload.php';

abstract class AbstractPlaygroundPlugin{    
    /**
     * Switch this to 'false' to disable debug info.
     */
    private static $debug = true;

    static function dump($o, $die=true){
        echo "\ndump(): " . json_encode([
            get_class($o) => [
                'vars' => array_keys(get_class_vars($o::class)),
                'methods' => get_class_methods($o),
            ]
        ], JSON_PRETTY_PRINT) . "\n";

        if($die){
            die();
        }
    }

    static function debug($function, $args){
        if(!static::$debug){
            return;
        }

        $event = array_shift($args);
        if($event === null){
            $message = static::getShortClass(static::class) . "::$function()";
        }
        else{
            $message = static::getLocation($event);
        }

        if($message !== null){
            echo "$message\n";
        }

        return null;
    }

    private static function getShortClass($class){
        if(gettype($class) !== 'string'){
            $class = get_class($class);
        }

        $parts = explode('\\', $class);
        return end($parts);
    }

    static function getLocation($event){
        $location = static::getShortClass($event);
        $filePath = null;

        if(method_exists($event, 'getStatementsSource')){
            [$filePath, $line, $start] = static::getStatementSourceLocationString($event);
        }
        else if(method_exists($event, 'getIssue')){
            [$filePath, $line, $start] = static::getCodeLocationString($event->getIssue()->code_location);
        }
        else if(in_array(get_class($event), [
            AfterCodebasePopulatedEvent::class,
            AfterAnalysisEvent::class
        ])){
            /**
             * No location info exists.  Just return the event name;
             */
            return $location;
        }

        if($filePath === null){
            echo "\n";
            static::dump($event);
            die("\n\nError detecting file path from event shown above!\n\n");
        }
        else if(
            str_contains($filePath, DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR)
            ||
            str_starts_with($filePath, 'vendor' . DIRECTORY_SEPARATOR)
        ){
            return null;
        }

        $location .= " - $filePath";
        if($start !== null){
            $content = file_get_contents($filePath);
            $nextNewLine = strpos($content, "\n", $start);
            if($nextNewLine === false){
                $length = null;
            }
            else{
                $length = $nextNewLine-$start;
            }

            $location .= ":$line " . substr($content, $start, $length);
        }

        return $location;
    }

    static function getStatementSourceLocationString($event){
        $statements_source = $event->getStatementsSource();
        $filePath = $statements_source->getFileName();

        if(
            in_array(get_class($event), [
                AfterClassLikeExistenceCheckEvent::class,
                AfterFileAnalysisEvent::class,
                BeforeFileAnalysisEvent::class,
            ])
        ){
            return [$filePath, null, null];
        }

        if(method_exists($event, 'getStmt')){
            $expr = $event->getStmt();
        }
        else{
            $expr = $event->getExpr();

            $subExpr = $expr->expr ?? null;
            if($subExpr){
                $expr = $subExpr;
            }
        }

        return [
            $filePath,
            $expr->getStartLine(),
            $expr->getStartFilePos(),
        ];
    }

    static function getCodeLocationString($l){
        return [$l->file_name, $l->raw_line_number, $l->raw_file_start];
    }
}

register_shutdown_function(function(){
    if(error_get_last() !== null){
        /**
         * This plugin is likely being developed right now.
         * Only display missing event handler messages once errors are fixed.
         */
        return;
    }

    $implementedInterfaces = [];
    foreach(get_declared_classes() as $class){
        if(str_contains($class, 'mmcev106\\PsalmPlaygroundPlugin\\')){
            $implementedInterfaces = array_merge(
                $implementedInterfaces,
                array_flip(class_implements($class))
            );
        }
    }
    
    $eventClass = new \ReflectionClass(AfterAnalysisEvent::class);
    $eventHandlerDir = dirname(dirname($eventClass->getFileName()));

    foreach(glob("$eventHandlerDir/*Interface.php") as $class){
        $shortClass = explode('.', basename($class))[0];

        if(in_array($shortClass, [
            'AddTaintsInterface',
            'RemoveTaintsInterface',
            'StringInterpreterInterface',
        ])){
            // Ignore undocumented event handlers.
            continue;
        }

        if(!isset($implementedInterfaces["Psalm\\Plugin\\EventHandler\\$shortClass"])){
            error_log("\nPlease create an issue at the following URL asking that support be added to PlaygroundPlugin1 (or one of the other playground plugins) for the '$shortClass' event handler:\n    https://github.com/mmcev106/psalm-playground-plugins/issues/new\n");
        }
    }
});