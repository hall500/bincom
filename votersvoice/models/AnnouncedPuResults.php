<?php

namespace app\models;

use Yii;
use app\models\PollingUnit;

/**
 * This is the model class for table "announced_pu_results".
 *
 * @property int $result_id
 * @property string $polling_unit_uniqueid
 * @property string $party_abbreviation
 * @property int $party_score
 * @property string $entered_by_user
 * @property string $date_entered
 * @property string $user_ip_address
 */
class AnnouncedPuResults extends \yii\db\ActiveRecord
{
    public $state_id;
    public $lga_id;
    public $ward_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announced_pu_results';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['polling_unit_uniqueid', 'party_abbreviation', 'party_score', 'entered_by_user', 'user_ip_address'], 'required'],
            [['party_score'], 'integer'],
            [['party_abbreviation'], 'unique'],
            [['polling_unit_uniqueid', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
            [['party_abbreviation'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'result_id' => 'Result ID',
            'polling_unit_uniqueid' => 'Polling Unit Uniqueid',
            'party_abbreviation' => 'Party Abbreviation',
            'party_score' => 'Party Score',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User Ip Address',
        ];
    }

    public function savePuResult($model, $id){
        $this->polling_unit_uniqueid =  strval($id);
        $this->party_abbreviation = (string) $model->partyid;
        $this->party_score = (int) $model->party_score;
        $this->entered_by_user = (string) "John Doe";
        $this->user_ip_address = (string) "127.0.0.1";
        if($this->validate()){
            return true;
        }
        return false;
    }
}
