<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property int $transaction_type 1- Sales, 2 - Sales Return, 3 -Purchase, 4 -Purchase Return , 5 -Stock Addition, 6 - Stock Deduction, 7 -Opening stock
 * @property int $transaction_id
 * @property int $material_id
 * @property string $material_code
 * @property int $yard_id
 * @property string $yard_code
 * @property string $material_cost
 * @property int $quantity_in
 * @property int $quantity_out
 * @property int $weight_in
 * @property int $weight_out
 * @property string $total_cost
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Materials $material
 * @property Yard $yard
 */
class Stock extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'stock';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['transaction_type', 'transaction_id', 'material_id', 'yard_id', 'status', 'CB', 'UB'], 'integer'],
                        [['transaction_id'], 'required'],
                        [['material_cost', 'total_cost', 'quantity_in', 'weight_in', 'weight_out', 'quantity_out',], 'number'],
                        [['DOC', 'DOU'], 'safe'],
                        [['material_code', 'yard_code'], 'string', 'max' => 20],
                        [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::className(), 'targetAttribute' => ['material_id' => 'id']],
                        [['yard_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yard::className(), 'targetAttribute' => ['yard_id' => 'id']],
                        [['DOC', 'material_id'], 'required', 'on' => 'daily-wise'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'transaction_type' => 'Transaction Type',
                    'transaction_id' => 'Transaction ID',
                    'material_id' => 'Material',
                    'material_code' => 'Material Code',
                    'yard_id' => 'Yard ID',
                    'yard_code' => 'Yard Code',
                    'material_cost' => 'Material Cost',
                    'quantity_in' => 'Quantity In',
                    'quantity_out' => 'Quantity Out',
                    'weight_in' => 'Weight In',
                    'weight_out' => 'Weight Out',
                    'total_cost' => 'Total Cost',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getMaterial() {
                return $this->hasOne(Materials::className(), ['id' => 'material_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getYard() {
                return $this->hasOne(Yard::className(), ['id' => 'yard_id']);
        }

        public function getQtyTotal($id) {
                $qty_in__sum = Stock::find()->where(['material_id' => $id])->sum('quantity_in');
                $qty_out__sum = Stock::find()->where(['material_id' => $id])->sum('quantity_out');
                $diff = $qty_in__sum - $qty_out__sum;
                return $diff;
        }

        public function dailyQtyTotal($id, $doc) {
                $qty_in__sum = Stock::find()->where(['material_id' => $id, 'DOC' => $doc])->sum('quantity_in');
                $qty_out__sum = Stock::find()->where(['material_id' => $id, 'DOC' => $doc])->sum('quantity_out');
                $diff = $qty_in__sum - $qty_out__sum;
                return $diff;
        }

        public function monthlyQtyTotal($id, $doc) {
                $date = date('Y-m', strtotime($doc));
                $date1 = $date . '-01';
                $date2 = $date . '-31';
                $qty_in__sum = Stock::find()->where(['material_id' => $id])->andWhere(['between', 'DOC', $date1, $date2])->sum('quantity_in');
                $qty_out__sum = Stock::find()->where(['material_id' => $id])->andWhere(['between', 'DOC', $date1, $date2])->sum('quantity_out');
                $diff = $qty_in__sum - $qty_out__sum;
                return $diff;
        }

}
