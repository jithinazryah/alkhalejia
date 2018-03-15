<?php

namespace backend\controllers;

use Yii;

class AjaxNotificationController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionNotifications() {
        if (Yii::$app->request->isAjax) {
            $this->PaymentNotificationAfter();
            $this->PaymentNotificationBefore();
            $this->PassportNotificationAfter();
            $this->PassportNotificationBefore();
            $this->SeamanBookNotificationAfter();
            $this->SeamanBookNotificationBefore();
            $this->PanamaNotificationAfter();
            $this->PanamaNotificationBefore();
            $this->CertificateNotificationAfter();
            $this->CertificateNotificationBefore();
            $this->PurchaseNotificationAfter();
            $this->PurchaseNotificationBefore();
            $this->PendingNotification();
            echo '1';
            exit;
        }
    }

    public function actionUpdateNotification() {
        if (Yii::$app->request->isAjax) {
            $id = $_POST['id'];
            $notification = \common\models\Notifications::findOne(['id' => $id]);
            $notification->status = 2;
            $notification->save();
            $notifications = \common\models\Notifications::find()->where(['status' => 1])->orderBy(['sort_order' => SORT_DESC])->limit(10)->all();
            $count = count($notifications);
            $i = 0;
            if ($count >= 10) {
                foreach ($notifications as $value) {
                    $i++;
                    if ($i == $count) {
                        $arr_variable = array('id' => $value->id, 'content' => $value->content, 'date' => $value->expiry_date);
                        $data['result'] = $arr_variable;
                        echo json_encode($data);
                    }
                }
            } else {
                echo 1;
                exit;
            }
        }
    }

    public function PaymentNotificationAfter() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $after_date = date('Y-m-d', strtotime('+2 days'));
        $payments = \common\models\PaymentMst::find()->where(['payment_mode' => 2])->andWhere(['>=', 'cheque_due_date', $current_date])->andWhere(['<=', 'cheque_due_date', $after_date])->all();
        foreach ($payments as $payment) {
            $payment_exist = \common\models\Notifications::find()->where(['notification_type' => 1, 'table_id' => $payment->id])->one();
            if (empty($payment_exist)) {
                $payment_notification = new \common\models\Notifications();
                $payment_notification->notification_type = 1;
                $payment_notification->table_id = $payment->id;
                $msg = 'Cheque Number <span class="line-col">' . $payment->cheque_no . ' </span> due date is on  <span class="line-col">' . $payment->cheque_due_date . '<span>';
                $msg1 = 'Cheque Number ' . $payment->cheque_no . ' due date is on ' . $payment->cheque_due_date;
                $payment_notification->content = $msg;
                $payment_notification->message = $msg1;
                $payment_notification->status = 1;
                $payment_notification->sort_order = 1;
                $payment_notification->expiry_date = $payment->cheque_due_date;
                $payment_notification->save();
            }
        }
        return;
    }

    public function PaymentNotificationBefore() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $before_date = date('Y-m-d', strtotime('-2 days'));
        $payments_before = \common\models\PaymentMst::find()->where(['payment_mode' => 2])->andWhere(['>=', 'cheque_due_date', $before_date])->andWhere(['<', 'cheque_due_date', $current_date])->all();
        foreach ($payments_before as $payment_before) {
            $payment_exist = \common\models\Notifications::find()->where(['notification_type' => 1, 'table_id' => $payment_before->id])->one();
            $msg = 'Cheque Number <span class="line-col">' . $payment_before->cheque_no . ' </span> expiry date is over on  <span class="line-col">' . $payment_before->cheque_due_date . '<span>';
            $msg1 = 'Cheque Number ' . $payment_before->cheque_no . ' expiry date is over on ' . $payment_before->cheque_due_date;
            if (empty($payment_exist)) {
                $payment_notification = new \common\models\Notifications();
                $payment_notification->notification_type = 1;
                $payment_notification->table_id = $payment_before->id;
                $payment_notification->content = $msg;
                $payment_notification->message = $msg1;
                $payment_notification->status = 1;
                $payment_notification->sort_order = 2;
                $payment_notification->expiry_date = $payment_before->cheque_due_date;
                $payment_notification->save();
            } else {
                if ($payment_exist->status == 1) {
                    $payment_exist->content = $msg;
                    $payment_exist->message = $msg1;
                    $payment_exist->sort_order = 2;
                    $payment_exist->update();
                }
            }
        }
        return;
    }

    public function PassportNotificationAfter() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $after_date = date('Y-m-d', strtotime('+2 days'));
        $passport_datas = \common\models\CrewInformationDetails::find()->where(['>=', 'passport_expiry_date', $current_date])->andWhere(['<=', 'passport_expiry_date', $after_date])->all();
        foreach ($passport_datas as $passport_data) {
            $passport_data_exist = \common\models\Notifications::find()->where(['notification_type' => 2, 'table_id' => $passport_data->id])->one();
            if (empty($passport_data_exist)) {
                $notification = new \common\models\Notifications();
                $notification->notification_type = 2;
                $notification->table_id = $passport_data->id;
                $msg = 'Crew Member<span class="line-col">' . \common\models\CrewInformation::findOne($passport_data->crew_id)->full_name . ' </span> passport will expire on  <span class="line-col">' . $passport_data->passport_expiry_date . '<span>';
                $msg1 = 'Crew Member ' . \common\models\CrewInformation::findOne($passport_data->crew_id)->full_name . ' passport will expire on ' . $passport_data->passport_expiry_date;
                $notification->content = $msg;
                $notification->message = $msg1;
                $notification->status = 1;
                $notification->sort_order = 1;
                $notification->expiry_date = $passport_data->passport_expiry_date;
                $notification->save();
            }
        }
        return;
    }

    public function PassportNotificationBefore() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $before_date = date('Y-m-d', strtotime('-2 days'));
        $passport_datas = \common\models\CrewInformationDetails::find()->where(['>=', 'passport_expiry_date', $before_date])->andWhere(['<', 'passport_expiry_date', $current_date])->all();
        foreach ($passport_datas as $passport_data) {
            $passport_data_exist = \common\models\Notifications::find()->where(['notification_type' => 2, 'table_id' => $passport_data->id])->one();
            $msg = 'Crew Member<span class="line-col">' . \common\models\CrewInformation::findOne($passport_data->crew_id)->full_name . ' </span> passport expiry date is over on  <span class="line-col">' . $passport_data->passport_expiry_date . '<span>';
            $msg1 = 'Crew Member ' . \common\models\CrewInformation::findOne($passport_data->crew_id)->full_name . ' passport expiry date is over on ' . $passport_data->passport_expiry_date;
            if (empty($passport_data_exist)) {
                $notification = new \common\models\Notifications();
                $notification->notification_type = 2;
                $notification->table_id = $passport_data->id;
                $notification->content = $msg;
                $notification->message = $msg1;
                $notification->status = 1;
                $notification->sort_order = 2;
                $notification->expiry_date = $passport_data->passport_expiry_date;
                $notification->save();
            } else {
                if ($passport_data_exist->status == 1) {
                    $passport_data_exist->content = $msg;
                    $passport_data_exist->message = $msg1;
                    $passport_data_exist->sort_order = 2;
                    $passport_data_exist->update();
                }
            }
        }
        return;
    }

    public function SeamanBookNotificationAfter() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $after_date = date('Y-m-d', strtotime('+2 days'));
        $seaman_book_datas = \common\models\CrewInformationDetails::find()->where(['>=', 'seaman_book_expiry_date', $current_date])->andWhere(['<=', 'seaman_book_expiry_date', $after_date])->all();
        foreach ($seaman_book_datas as $seaman_book_data) {
            $seaman_book_data_exist = \common\models\Notifications::find()->where(['notification_type' => 3, 'table_id' => $seaman_book_data->id])->one();
            if (empty($seaman_book_data_exist)) {
                $notification = new \common\models\Notifications();
                $notification->notification_type = 3;
                $notification->table_id = $seaman_book_data->id;
                $msg = 'Crew Member<span class="line-col">' . \common\models\CrewInformation::findOne($seaman_book_data->crew_id)->full_name . ' </span> seaman book will expire on  <span class="line-col">' . $seaman_book_data->seaman_book_expiry_date . '<span>';
                $msg1 = 'Crew Member ' . \common\models\CrewInformation::findOne($seaman_book_data->crew_id)->full_name . ' seaman book will expire on ' . $seaman_book_data->seaman_book_expiry_date;
                $notification->content = $msg;
                $notification->message = $msg1;
                $notification->status = 1;
                $notification->sort_order = 1;
                $notification->expiry_date = $seaman_book_data->seaman_book_expiry_date;
                $notification->save();
            }
        }
        return;
    }

    public function SeamanBookNotificationBefore() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $before_date = date('Y-m-d', strtotime('-2 days'));
        $seaman_book_datas = \common\models\CrewInformationDetails::find()->where(['>=', 'seaman_book_expiry_date', $before_date])->andWhere(['<', 'seaman_book_expiry_date', $current_date])->all();
        foreach ($seaman_book_datas as $seaman_book_data) {
            $seaman_book_data_exist = \common\models\Notifications::find()->where(['notification_type' => 3, 'table_id' => $seaman_book_data->id])->one();
            $msg = 'Crew Member<span class="line-col">' . \common\models\CrewInformation::findOne($seaman_book_data->crew_id)->full_name . ' </span> seaman book expiry date is over on  <span class="line-col">' . $seaman_book_data->seaman_book_expiry_date . '<span>';
            $msg1 = 'Crew Member ' . \common\models\CrewInformation::findOne($seaman_book_data->crew_id)->full_name . ' seaman book expiry date is over on ' . $seaman_book_data->seaman_book_expiry_date;
            if (empty($seaman_book_data_exist)) {
                $notification = new \common\models\Notifications();
                $notification->notification_type = 3;
                $notification->table_id = $seaman_book_data->id;
                $notification->content = $msg;
                $notification->message = $msg1;
                $notification->status = 1;
                $notification->sort_order = 2;
                $notification->expiry_date = $seaman_book_data->seaman_book_expiry_date;
                $notification->save();
            } else {
                if ($seaman_book_data_exist->status == 1) {
                    $seaman_book_data_exist->content = $msg;
                    $seaman_book_data_exist->message = $msg1;
                    $seaman_book_data_exist->sort_order = 2;
                    $seaman_book_data_exist->update();
                }
            }
        }
        return;
    }

    public function PanamaNotificationAfter() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $after_date = date('Y-m-d', strtotime('+2 days'));
        $panama_datas = \common\models\CrewInformationDetails::find()->where(['>=', 'panama_endorsement_expiry_date', $current_date])->andWhere(['<=', 'panama_endorsement_expiry_date', $after_date])->all();
        foreach ($panama_datas as $panama_data) {
            $panama_data_exist = \common\models\Notifications::find()->where(['notification_type' => 4, 'table_id' => $panama_data->id])->one();
            if (empty($panama_data_exist)) {
                $notification = new \common\models\Notifications();
                $notification->notification_type = 4;
                $notification->table_id = $panama_data->id;
                $msg = 'Crew Member<span class="line-col">' . \common\models\CrewInformation::findOne($panama_data->crew_id)->full_name . ' </span> panama endorsement will expire on  <span class="line-col">' . $panama_data->panama_endorsement_expiry_date . '<span>';
                $msg1 = 'Crew Member ' . \common\models\CrewInformation::findOne($panama_data->crew_id)->full_name . ' panama endorsement will expire on ' . $panama_data->panama_endorsement_expiry_date;
                $notification->content = $msg;
                $notification->message = $msg1;
                $notification->status = 1;
                $notification->sort_order = 1;
                $notification->expiry_date = $panama_data->panama_endorsement_expiry_date;
                $notification->save();
            }
        }
        return;
    }

    public function PanamaNotificationBefore() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $before_date = date('Y-m-d', strtotime('-2 days'));
        $panama_datas = \common\models\CrewInformationDetails::find()->where(['>=', 'panama_endorsement_expiry_date', $before_date])->andWhere(['<', 'panama_endorsement_expiry_date', $current_date])->all();
        foreach ($panama_datas as $panama_data) {
            $panama_data_exist = \common\models\Notifications::find()->where(['notification_type' => 4, 'table_id' => $panama_data->id])->one();
            $msg = 'Crew Member<span class="line-col">' . \common\models\CrewInformation::findOne($panama_data->crew_id)->full_name . ' </span> panama endorsement expiry date is over on  <span class="line-col">' . $panama_data->panama_endorsement_expiry_date . '<span>';
            $msg1 = 'Crew Member ' . \common\models\CrewInformation::findOne($panama_data->crew_id)->full_name . ' panama endorsement expiry date is over on ' . $panama_data->panama_endorsement_expiry_date;
            if (empty($panama_data_exist)) {
                $notification = new \common\models\Notifications();
                $notification->notification_type = 4;
                $notification->table_id = $panama_data->id;
                $notification->content = $msg;
                $notification->message = $msg1;
                $notification->status = 1;
                $notification->sort_order = 2;
                $notification->expiry_date = $panama_data->panama_endorsement_expiry_date;
                $notification->save();
            } else {
                if ($panama_data_exist->status == 1) {
                    $panama_data_exist->content = $msg;
                    $panama_data_exist->message = $msg1;
                    $panama_data_exist->sort_order = 2;
                    $panama_data_exist->update();
                }
            }
        }
        return;
    }

    public function CertificateNotificationAfter() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $after_date = date('Y-m-d', strtotime('+2 days'));
        $certificate_datas = \common\models\CrewCertificate::find()->where(['>=', 'date_of_expiry', $current_date])->andWhere(['<=', 'date_of_expiry', $after_date])->all();
        foreach ($certificate_datas as $certificate_data) {
            $certificate_data_exist = \common\models\Notifications::find()->where(['notification_type' => 5, 'table_id' => $certificate_data->id])->one();
            if (empty($certificate_data_exist)) {
                $notification = new \common\models\Notifications();
                $notification->notification_type = 5;
                $notification->table_id = $certificate_data->id;
                $msg = 'Crew Member<span class="line-col">' . \common\models\CrewInformation::findOne($certificate_data->crew_id)->full_name . ' </span> certificate <span class="line-col">' . \common\models\CertificateType::findOne($certificate_data->certificate_id)->certificate_name . '</span> will expire on  <span class="line-col">' . $certificate_data->date_of_expiry . '<span>';
                $msg1 = 'Crew Member ' . \common\models\CrewInformation::findOne($certificate_data->crew_id)->full_name . ' certificate ' . \common\models\CertificateType::findOne($certificate_data->certificate_id)->certificate_name . ' will expire on ' . $certificate_data->date_of_expiry;
                $notification->content = $msg;
                $notification->message = $msg1;
                $notification->status = 1;
                $notification->sort_order = 1;
                $notification->expiry_date = $certificate_data->date_of_expiry;
                $notification->save();
            }
        }
        return;
    }

    public function CertificateNotificationBefore() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $before_date = date('Y-m-d', strtotime('-2 days'));
        $certificate_datas = \common\models\CrewCertificate::find()->where(['>=', 'date_of_expiry', $before_date])->andWhere(['<', 'date_of_expiry', $current_date])->all();
        foreach ($certificate_datas as $certificate_data) {
            $certificate_data_exist = \common\models\Notifications::find()->where(['notification_type' => 5, 'table_id' => $certificate_data->id])->one();
            $msg = 'Crew Member<span class="line-col">' . \common\models\CrewInformation::findOne($certificate_data->crew_id)->full_name . ' </span> certificate <span class="line-col">' . \common\models\CertificateType::findOne($certificate_data->certificate_id)->certificate_name . '</span> expiry date is over on  <span class="line-col">' . $certificate_data->date_of_expiry . '<span>';
            $msg1 = 'Crew Member ' . \common\models\CrewInformation::findOne($certificate_data->crew_id)->full_name . ' certificate ' . \common\models\CertificateType::findOne($certificate_data->certificate_id)->certificate_name . ' expiry date is over on ' . $certificate_data->date_of_expiry;
            if (empty($certificate_data_exist)) {
                $notification = new \common\models\Notifications();
                $notification->notification_type = 5;
                $notification->table_id = $certificate_data->id;
                $notification->content = $msg;
                $notification->message = $msg1;
                $notification->status = 1;
                $notification->sort_order = 2;
                $notification->expiry_date = $certificate_data->date_of_expiry;
                $notification->save();
            } else {
                if ($certificate_data_exist->status == 1) {
                    $certificate_data_exist->content = $msg;
                    $certificate_data_exist->message = $msg1;
                    $certificate_data_exist->sort_order = 2;
                    $certificate_data_exist->update();
                }
            }
        }
        return;
    }

    public function PurchaseNotificationAfter() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $after_date = date('Y-m-d', strtotime('+2 days'));
        $purchase_orders = \common\models\PurchaseOrderMst::find()->where(['payment_mode' => 2])->andWhere(['>=', 'cheque_date', $current_date])->andWhere(['<=', 'cheque_date', $after_date])->all();
        foreach ($purchase_orders as $purchase_order) {
            $purchase_order_exist = \common\models\Notifications::find()->where(['notification_type' => 6, 'table_id' => $purchase_order->id])->one();
            if (empty($purchase_order_exist)) {
                $payment_notification = new \common\models\Notifications();
                $payment_notification->notification_type = 6;
                $payment_notification->table_id = $purchase_order->id;
                $msg = 'Cheque Number <span class="line-col">' . $purchase_order->cheque_number . ' </span> due date is on  <span class="line-col">' . $purchase_order->cheque_date . '<span>';
                $msg1 = 'Cheque Number ' . $purchase_order->cheque_number . ' due date is on ' . $purchase_order->cheque_date;
                $payment_notification->content = $msg;
                $payment_notification->message = $msg1;
                $payment_notification->status = 1;
                $payment_notification->sort_order = 1;
                $payment_notification->expiry_date = $purchase_order->cheque_date;
                $payment_notification->save();
            }
        }
        return;
    }

    public function PurchaseNotificationBefore() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        $before_date = date('Y-m-d', strtotime('-2 days'));
        $purchase_orders = \common\models\PurchaseOrderMst::find()->where(['payment_mode' => 2])->andWhere(['>=', 'cheque_date', $before_date])->andWhere(['<', 'cheque_date', $current_date])->all();
        foreach ($purchase_orders as $purchase_order) {
            $purchase_order_exist = \common\models\Notifications::find()->where(['notification_type' => 6, 'table_id' => $purchase_order->id])->one();
            $msg = 'Cheque Number <span class="line-col">' . $purchase_order->cheque_number . ' </span> expiry date is over on  <span class="line-col">' . $purchase_order->cheque_date . '<span>';
            $msg1 = 'Cheque Number ' . $purchase_order->cheque_number . ' expiry date is over on ' . $purchase_order->cheque_date;
            if (empty($purchase_order_exist)) {
                $payment_notification = new \common\models\Notifications();
                $payment_notification->notification_type = 6;
                $payment_notification->table_id = $purchase_order->id;
                $payment_notification->content = $msg;
                $payment_notification->message = $msg1;
                $payment_notification->status = 1;
                $payment_notification->sort_order = 2;
                $payment_notification->expiry_date = $purchase_order->cheque_date;
                $payment_notification->save();
            } else {
                if ($purchase_order_exist->status == 1) {
                    $purchase_order_exist->content = $msg;
                    $purchase_order_exist->message = $msg1;
                    $purchase_order_exist->sort_order = 2;
                    $purchase_order_exist->update();
                }
            }
        }
        return;
    }

    public function PendingNotification() {
        date_default_timezone_set('Asia/Kolkata');
        $before_date = date('Y-m-d', strtotime('-2 days'));
        $Notification_datas = \common\models\Notifications::find()->where(['<', 'expiry_date', $before_date])->andWhere(['status' => 1])->all();
        foreach ($Notification_datas as $Notification_data) {
            $Notification_data->status = 3;
            $Notification_data->update();
        }
        return;
    }

}
