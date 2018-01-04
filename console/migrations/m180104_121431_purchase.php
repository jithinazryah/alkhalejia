<?php

use yii\db\Migration;

/**
 * Class m180104_121431_purchase
 */
class m180104_121431_purchase extends Migration {

        /**
         * @inheritdoc
         */
        public function safeUp() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%purchase}}', [
                    'id' => $this->primaryKey(),
                    'received_date' => $this->dateTime()->null(),
                    'material' => $this->integer()->notNull(),
                    'supplier' => $this->integer()->notNull(),
                    'transport' => $this->integer()->notNull(),
                    'ticket_no' => $this->string(20)->null(),
                    'truck_number' => $this->string()->null(),
                    'gross_weight' => $this->string()->null(),
                    'tare_weight' => $this->string()->null(),
                    'net_weight' => $this->string()->null(),
                    'rate' => $this->decimal(10, 2)->null(),
                    'total' => $this->decimal(10, 2)->null(),
                    'description' => $this->text()->null(),
                    'status' => $this->integer()->Null(),
                    'CB' => $this->integer()->Null(),
                    'UB' => $this->integer()->Null(),
                    'DOC' => $this->date(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);

                $this->addForeignKey("fk_purchase_material", "purchase", "material", "materials", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("fk_purchase_supplier", "purchase", "supplier", "contacts", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("fk_purchase_transport", "purchase", "transport", "contacts", "id", "RESTRICT", "RESTRICT");
        }

        /**
         * @inheritdoc
         */
        public function safeDown() {
                echo "m180104_121431_purchase cannot be reverted.\n";

                return false;
        }

        /*
          // Use up()/down() to run migration code without a transaction.
          public function up()
          {

          }

          public function down()
          {
          echo "m180104_121431_purchase cannot be reverted.\n";

          return false;
          }
         */
}
