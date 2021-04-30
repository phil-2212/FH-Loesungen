<?php

/**
 * Um die verschiedenen Simulatoren über die selben Schnittstellen anzusprechen
 * erzeugen wir ein Interface in dem wir ausschließlich die s.g. Methodensignaturen vereinbaren
 * die einen implementierende Klasse haben muss.
 * @author helmuth
 */
interface LoopSimulatorInterface {
    
    public function setWorkArray($workingArray);
    public function getSimulationResult();
    
}
