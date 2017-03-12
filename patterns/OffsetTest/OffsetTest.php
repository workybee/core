<?php
/** Freesewing\Patterns\OffsetTest class */
namespace Freesewing\Patterns;

use Freesewing\Utils;
use Freesewing\BezierToolbox;

/**
 * A pattern template
 *
 * If you'd like to add you own pattern, you can copy this class/directory.
 * It's an empty skeleton for you to start working with
 *
 * @author Joost De Cock <joost@decock.org>
 * @copyright 2017 Joost De Cock
 * @license http://opensource.org/licenses/GPL-3.0 GNU General Public License, Version 3
 */
class OffsetTest extends Pattern
{
    public function sample($model)
    {
        return true;
    }

    public function draft($model)
    {
        /** @var \Freesewing\Part $p */
        $start = microtime(true);
        for($i=1;$i<6;$i++) {
            for($j=1;$j<6;$j++) {
                for($k=1;$k<6;$k++) {
                    $id = "$i.$j.$k";
                    $this->newPart($id);
                    $p = $this->parts[$id];
                    $p->newPoint("$id-cp1", $i*-10, 0);
                    $p->addPoint("$id-cp2", $p->flipX("$id-cp1"));
                    $p->addPoint("$id-start", $p->shift("$id-cp1",-90 - $j*9,$k*10));
                    $p->addPoint("$id-end", $p->flipX("$id-start"));
                    $p->newPath($id, "M $id-start C $id-cp1 $id-cp2 $id-end");
                    $p->offsetPath("$id-offsetIn", $id, 10, 1, ['class' => 'stroke-sm stroke-note']);
                    $p->offsetPath("$id-offsetOut", $id, -10, 1, ['class' => 'stroke-sm stroke-warning']);
                    $p->newTextOnPath(
                        $p->newId(),
                        "M $id-start C $id-cp1 $id-cp2 $id-end", 
                        count($p->paths["$id-offsetIn"]->breakUp()).' segments',
                        ['class' => 'text-center text-sm fill-note', 'dy' => 8]
                    );
                    $p->newTextOnPath(
                        $p->newId(),
                        "M $id-start C $id-cp1 $id-cp2 $id-end", 
                        count($p->paths["$id-offsetOut"]->breakUp()).' segments',
                        ['class' => 'text-center text-sm fill-warning', 'dy' => -6]
                    );
                }
            }
        }
        $end = microtime(true);
        $tt = round($end-$start,2);
        $this->newPart('time');
        $p = $this->parts['time'];
        $p->newPoint(1,0,0);
        $p->newPoint(2,$tt*40,0);
        $p->newPath(1,'M 1 L 2');
        $p->newLinearDimension(1, 2, 10, "Time taken: $tt seconds");
    }
}
