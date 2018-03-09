<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Ships;
use common\models\Ports;

/* @var $this yii\web\View */
/* @var $model common\models\CrewInformation */
$this->title = 'Crew Information for : ' . $crew->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Crew Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Crew Information</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div style="float: right;widows: 100px;height: 100px;">
                    <?php
                    if ($crew->photo != '') {
                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/crew_information/profile_picture/' . $crew->id . '.' . $crew->photo;
                        if (file_exists($dirPath)) {
                            $img = '<img width="120px" src="' . Yii::$app->homeUrl . '/uploads/crew_information/profile_picture/' . $crew->id . '.' . $crew->photo . '"/>';
                            echo $img;
                        }
                    }
                    ?>
                </div>
                <div class="panel-body">
                    <div class="crew-information-view">
                        <h4 class="crew-sub-head">Personal Information</h4>
                        <table class="table table-responsive table-crew-view">
                            <tr>
                                <th>vessel</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->vessel != '' ? Ships::findOne($crew->vessel)->name : '' ?></td>
                                <th>Port</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->port != '' ? Ports::findOne($crew->port)->port_name : '' ?></td>
                                <th>Agent</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->agent != '' ? $crew->agent : '' ?></td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->full_name != '' ? $crew->full_name : '' ?></td>
                                <th>Rank</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->rank != '' ? $crew->rank : '' ?></td>
                                <th>Nationality</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->nationality != '' ? $crew->nationality : '' ?></td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->date_of_birth != '' ? $crew->date_of_birth : '' ?></td>
                                <th>Place of Birth</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->place_of_birth != '' ? $crew->place_of_birth : '' ?></td>
                                <th>Residential Address</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->residential_address != '' ? $crew->residential_address : '' ?></td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->phone_number != '' ? $crew->phone_number : '' ?></td>
                                <th>Marital Status</th>
                                <td><span class="seperation">:</span></td>
                                <td>
                                    <?php
                                    if ($crew->marital_status == 1) {
                                        echo 'Married';
                                    } elseif ($crew->marital_status == 2) {
                                        echo 'Single';
                                    } elseif ($crew->marital_status == 3) {
                                        echo 'Divorced';
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </td>
                                <th>Mother's Name</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->mothers_name != '' ? $crew->mothers_name : '' ?></td>
                            </tr>
                            <tr>
                                <th>Father's Name</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->fathers_name != '' ? $crew->fathers_name : '' ?></td>
                                <th>Joining Date</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->joining_date != '' ? $crew->joining_date : '' ?></td>
                                <th>Religion</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->religion != '' ? $crew->religion : '' ?></td>
                            </tr>
                            <tr>
                                <th>First Language</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew->first_language != '' ? $crew->first_language : '' ?></td>
                                <th>Sex</th>
                                <td><span class="seperation">:</span></td>
                                <td>
                                    <?php
                                    if ($crew->sex == 1) {
                                        echo 'Male';
                                    } elseif ($crew->sex == 2) {
                                        echo 'Female';
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </td>
                                <th></th>
                                <td><span class="seperation"></span></td>
                                <td></td>
                            </tr>
                        </table>
                        <h4 class="crew-sub-head">Passport Details</h4>
                        <table class="table table-responsive table-crew-view">
                            <tr>
                                <th>Passport Number </th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->passport_no != '' ? $crew_details->passport_no : '' ?></td>
                                <th>Passport Issue Date</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->passport_issue_date != '' ? $crew_details->passport_issue_date : '' ?></td>
                            </tr>
                            <tr>
                                <th>Passport Expiry Date </th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->passport_expiry_date != '' ? $crew_details->passport_expiry_date : '' ?></td>
                                <th>Passport Issued By</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->passport_issued_by != '' ? $crew_details->passport_issued_by : '' ?></td>
                            </tr>
                        </table>
                        <h4 class="crew-sub-head">Seaman Book Details</h4>
                        <table class="table table-responsive table-crew-view">
                            <tr>
                                <th>Seaman Book Number </th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->seaman_book_no != '' ? $crew_details->seaman_book_no : '' ?></td>
                                <th>Seaman Book Issue Date</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->seaman_book_issue_date != '' ? $crew_details->seaman_book_issue_date : '' ?></td>
                            </tr>
                            <tr>
                                <th>Seaman Book Expiry Date </th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->seaman_book_expiry_date != '' ? $crew_details->seaman_book_expiry_date : '' ?></td>
                                <th>Seaman Book Issued By</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->seaman_book_issued_by != '' ? $crew_details->seaman_book_issued_by : '' ?></td>
                            </tr>
                        </table>
                        <table class="table table-responsive table-crew-view">
                            <tr>
                                <th>Educational Attainment</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->educational_attainment != '' ? $crew_details->educational_attainment : '' ?></td>
                                <th>Panama Endorsement No</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->panama_endorsement_no != '' ? $crew_details->panama_endorsement_no : '' ?></td>
                            </tr>
                            <tr>
                                <th>Panama Endorsement Expiry Date</th>
                                <td><span class="seperation">:</span></td>
                                <td><?= $crew_details->panama_endorsement_expiry_date != '' ? $crew_details->panama_endorsement_expiry_date : '' ?></td>
                                <th></th>
                                <td><span class="seperation"></span></td>
                                <td></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


