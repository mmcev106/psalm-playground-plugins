<?php namespace mmcev106\PsalmPlaygroundPlugin;

class PlaygroundPlugin3 extends AbstractPlaygroundPlugin implements
    \Psalm\Plugin\EventHandler\AfterStatementAnalysisInterface
{
    static function afterStatementAnalysis(\Psalm\Plugin\EventHandler\Event\AfterStatementAnalysisEvent $event): ?bool{
        static::debug(__FUNCTION__, func_get_args());
        return null;
    }
}