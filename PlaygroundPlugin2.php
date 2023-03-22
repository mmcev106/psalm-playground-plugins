<?php namespace mmcev106\PsalmPlaygroundPlugin;

class PlaygroundPlugin2 extends AbstractPlaygroundPlugin implements
    \Psalm\Plugin\EventHandler\AfterFunctionLikeAnalysisInterface
{
    static function afterStatementAnalysis(\Psalm\Plugin\EventHandler\Event\AfterFunctionLikeAnalysisEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
        return null;
    }
}