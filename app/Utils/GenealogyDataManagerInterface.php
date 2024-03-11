<?php
namespace App\Utils;

interface GenealogyDataManagerInterface {
    public function isUpgradable($user);
    public function setBonusesRecords($user);
    public function getLevelGenerationFieldBonus($level, $generation);
    public function browseAllGenalogy();
}