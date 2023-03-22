<?php namespace mmcev106\PsalmPlaygroundPlugin;

require_once 'vendor/autoload.php';

use Psalm\Plugin\EventHandler\Event\AfterFileAnalysisEvent;
use Psalm\Plugin\EventHandler\Event\AfterClassLikeExistenceCheckEvent;
use Psalm\Plugin\EventHandler\Event\BeforeFileAnalysisEvent;
use Psalm\Type\Union;
use Psalm\Plugin\DynamicFunctionStorage;

class PlaygroundPlugin1 extends AbstractPlaygroundPlugin implements
    \Psalm\Plugin\EventHandler\AfterAnalysisInterface,
    \Psalm\Plugin\EventHandler\AfterClassLikeAnalysisInterface,
    \Psalm\Plugin\EventHandler\AfterClassLikeExistenceCheckInterface,
    \Psalm\Plugin\EventHandler\AfterClassLikeVisitInterface,
    \Psalm\Plugin\EventHandler\AfterCodebasePopulatedInterface,
    \Psalm\Plugin\EventHandler\AfterEveryFunctionCallAnalysisInterface,
    \Psalm\Plugin\EventHandler\AfterExpressionAnalysisInterface,
    \Psalm\Plugin\EventHandler\AfterFileAnalysisInterface,
    \Psalm\Plugin\EventHandler\AfterFunctionCallAnalysisInterface,
    \Psalm\Plugin\EventHandler\AfterMethodCallAnalysisInterface,
    \Psalm\Plugin\EventHandler\BeforeStatementAnalysisInterface,
    \Psalm\Plugin\EventHandler\BeforeAddIssueInterface,
    \Psalm\Plugin\EventHandler\BeforeFileAnalysisInterface,
    \Psalm\Plugin\EventHandler\FunctionExistenceProviderInterface,
    \Psalm\Plugin\EventHandler\FunctionParamsProviderInterface,
    \Psalm\Plugin\EventHandler\FunctionReturnTypeProviderInterface,
    \Psalm\Plugin\EventHandler\MethodExistenceProviderInterface,
    \Psalm\Plugin\EventHandler\MethodParamsProviderInterface,
    \Psalm\Plugin\EventHandler\MethodReturnTypeProviderInterface,
    \Psalm\Plugin\EventHandler\MethodVisibilityProviderInterface,
    \Psalm\Plugin\EventHandler\PropertyExistenceProviderInterface,
    \Psalm\Plugin\EventHandler\PropertyTypeProviderInterface,
    \Psalm\Plugin\EventHandler\PropertyVisibilityProviderInterface,
    \Psalm\Plugin\EventHandler\DynamicFunctionStorageProviderInterface
{
    static function afterStatementAnalysis(\Psalm\Plugin\EventHandler\Event\AfterClassLikeAnalysisEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
        return null;
    }

    static function afterAnalysis(\Psalm\Plugin\EventHandler\Event\AfterAnalysisEvent $event): void{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function afterClassLikeExistenceCheck(AfterClassLikeExistenceCheckEvent $event): void{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function afterClassLikeVisit(\Psalm\Plugin\EventHandler\Event\AfterClassLikeVisitEvent $event){
        static::debug(__FUNCTION__, func_get_args());
    }

    static function afterCodebasePopulated(\Psalm\Plugin\EventHandler\Event\AfterCodebasePopulatedEvent $event){
        static::debug(__FUNCTION__, func_get_args());
    }

    static function afterEveryFunctionCallAnalysis(\Psalm\Plugin\EventHandler\Event\AfterEveryFunctionCallAnalysisEvent $event): void{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function afterExpressionAnalysis(\Psalm\Plugin\EventHandler\Event\AfterExpressionAnalysisEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
        return null;
    }

    static function afterAnalyzeFile(AfterFileAnalysisEvent $event): void{
        static::debug(__FUNCTION__, func_get_args());
    }
    
    static function afterFunctionCallAnalysis(\Psalm\Plugin\EventHandler\Event\AfterFunctionCallAnalysisEvent $event): void{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function afterMethodCallAnalysis(\Psalm\Plugin\EventHandler\Event\AfterMethodCallAnalysisEvent $event): void{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function beforeStatementAnalysis(\Psalm\Plugin\EventHandler\Event\BeforeStatementAnalysisEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
        return null;
    }

    static function beforeAddIssue(\Psalm\Plugin\EventHandler\Event\BeforeAddIssueEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
        return null;
    }

    static function beforeAnalyzeFile(BeforeFileAnalysisEvent $event): void{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function getFunctionIds(): array{
        // static::debug(__FUNCTION__, func_get_args());
        return ['some_function_that_does_not_exist'];
    }
    
    static function doesFunctionExist(\Psalm\Plugin\EventHandler\Event\FunctionExistenceProviderEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
    }
    
    static function getFunctionParams(\Psalm\Plugin\EventHandler\Event\FunctionParamsProviderEvent $event): ?array{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function getFunctionReturnType(\Psalm\Plugin\EventHandler\Event\FunctionReturnTypeProviderEvent $event): ?Union{
        static::debug(__FUNCTION__, func_get_args());
    }
    
    static function getClassLikeNames(): array{
        // static::debug(__FUNCTION__, func_get_args());
        return ['SomeClassThatDoesNotExist'];
    }
    
    static function doesMethodExist(\Psalm\Plugin\EventHandler\Event\MethodExistenceProviderEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function getMethodParams(\Psalm\Plugin\EventHandler\Event\MethodParamsProviderEvent $event): ?array{
        static::debug(__FUNCTION__, func_get_args());
    }
    
    static function getMethodReturnType(\Psalm\Plugin\EventHandler\Event\MethodReturnTypeProviderEvent $event): ?Union{
        static::debug(__FUNCTION__, func_get_args());
    }
    
    static function isMethodVisible(\Psalm\Plugin\EventHandler\Event\MethodVisibilityProviderEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function doesPropertyExist(\Psalm\Plugin\EventHandler\Event\PropertyExistenceProviderEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
    }
    
    static function getPropertyType(\Psalm\Plugin\EventHandler\Event\PropertyTypeProviderEvent $event): ?Union{
        static::debug(__FUNCTION__, func_get_args());
    }
    
    static function isPropertyVisible(\Psalm\Plugin\EventHandler\Event\PropertyVisibilityProviderEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
    }

    static function getFunctionStorage(\Psalm\Plugin\EventHandler\Event\DynamicFunctionStorageProviderEvent $event): ?DynamicFunctionStorage{
        static::debug(__FUNCTION__, func_get_args());
    }
}
