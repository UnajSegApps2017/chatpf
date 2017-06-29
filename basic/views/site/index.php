<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to Chatpf!</h1>

        <p class="lead">Voice message based on confidentiality and GNUPG.</p>

        <!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p> -->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>GNUPG</h2>

                <p>GnuPG is a complete and free implementation of the OpenPGP standard as defined by RFC4880 (also known as PGP). 
                GnuPG allows to encrypt and sign your data and communication, features a versatile key management system as well 
                as access modules for all kinds of public key directories. GnuPG, also known as GPG, is a command line tool with 
                features for easy integration with other applications </p>

                <p><a class="btn btn-default" href="https://gnupg.org/">Official Site </a></p>
            </div>
            <div class="col-lg-6">
                <h2>Voice Message</h2>

                <p>You can send encrypted voice message assuring confidentiality. In this way, the voice message could be read only
                for the correct people. Even if the message is stolen by a intruder or the message is captured during delivery moment.</p>
				
				 <?= Html::a('Register!', ['site/register'], ['class'=>'btn btn-default']) ?> 
	
				
                <!-- <a class="btn btn-default" href="site/login">Register! &raquo;</a></p> -->
            </div>
        </div>
    </div>
</div>
