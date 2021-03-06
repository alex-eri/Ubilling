<?php

/*
 * Including all needed APIs and Libs
 */
include('api/libs/api.mysql.php');
include('api/libs/api.ubstorage.php');
include('api/api.stargazer.php');
include('api/libs/api.compat.php');
include('api/libs/api.morph.php');
include('api/libs/api.ubconfig.php');
include('api/libs/api.ubcache.php');
include('api/libs/api.astral.php');
include('api/libs/api.barcodeqr.php');
include('api/libs/api.dbconnect.php');
include('api/libs/api.userdata.php');
include('api/libs/api.usersearch.php');
include('api/libs/api.address.php');
include('api/libs/api.telepathy.php');
include('api/libs/api.taskman.php');
include('api/libs/api.networking.php');
include('api/libs/api.dhcp.php');
include('api/libs/api.userreg.php');
include('api/libs/api.workicons.php');
include('api/libs/api.workaround.php');
include('api/libs/api.usms.php');
include('api/libs/api.payments.php');
include('api/libs/api.usertags.php');
include('api/libs/api.cess.php');
include('api/libs/api.cardpay.php');
include('api/libs/api.cf.php');
include('api/libs/api.switches.php');
include('api/libs/api.gravatar.php');
include('api/libs/api.ticketing.php');
include('api/libs/api.catv.php');
include('api/libs/api.corporate.php');
include('api/libs/api.lousytariffs.php');
include('api/libs/api.banksta.php');
include('api/libs/api.templatize.php');
include('api/libs/api.custmaps.php');
include('api/libs/api.deploy.php');
include('api/libs/api.crm.php');
include('api/libs/api.help.php');
include('api/libs/api.ubim.php');
include('api/libs/api.snmp.php');
include('api/libs/api.swpoll.php');
include('api/libs/api.routeros.php');
include('api/libs/api.watchdog.php');
include('api/libs/api.docx.php');
include('api/libs/api.documents.php');
include('api/libs/api.dbf.php');
include('api/libs/api.ukv.php');
include('api/libs/api.idlelogout.php');
include('api/libs/api.corps.php');
include('api/libs/api.extnets.php');
include('api/libs/api.assignreport.php');
include('api/libs/api.capabdir.php');
include('api/libs/api.sigreq.php');
include('api/libs/api.roskomnadzor.php');
include('api/libs/api.condet.php');
include('api/libs/api.userprofile.php');
include('api/libs/api.stickynotes.php');
include('api/libs/api.fundsflow.php');
include('api/libs/api.adcomments.php');
include('api/libs/api.vlan.php');
include('api/libs/api.globalsearch.php');
include('api/libs/api.darkvoid.php');
include('api/libs/api.globalmenu.php');
include('api/libs/api.loginform.php');
include('api/libs/api.photostorage.php');
include('api/libs/api.dshaper.php');
include('api/libs/api.uhw.php');
include('api/libs/api.pon.php');
include('api/libs/api.cudiscounts.php');
include('api/libs/api.cap.php');
include('api/libs/api.opayz.php');
include('api/libs/api.salary.php');
include('api/libs/api.cemetery.php');
include('api/libs/api.warehouse.php');
include('api/libs/api.reminder.php');
include('api/libs/api.friendship.php');
include('api/libs/api.migration.php');
include('api/libs/api.percity.php');
include('api/libs/api.dealwithit.php');
include('api/libs/api.megogo.php');
include('api/libs/api.userside.php');
include('api/libs/api.whois.php');
include('api/libs/api.email.php');
include('api/libs/api.exhorse.php');
include('api/libs/api.telegram.php');
include('api/libs/api.senddog.php');
include('api/libs/api.smszilla.php');
include('api/libs/api.tsupport.php');
include('api/libs/api.asterisk.php');
include('api/libs/api.policedog.php');
include('api/libs/api.branches.php');
include('api/libs/api.selling.php');
include('api/libs/api.printcard.php');
include('api/libs/api.generatecard.php');
include('api/vendor/fpdf/fpdf.php');
include('api/libs/api.updates.php');
include('api/libs/api.wdyc.php');
include('api/libs/api.mapscommon.php');
include('api/libs/api.mapscompat.php');
include('api/libs/api.announcements.php');
include('api/libs/api.jungen.php');
include('api/libs/api.nasmon.php');
include('api/libs/api.ipchange.php');
include('api/libs/api.messagesqueue.php');
include('api/libs/api.wcpe.php');
include('api/libs/api.mtsigmon.php');
include('api/libs/api.taskbar.php');

/*
 * Initial class creation
 */
$billing = new ApiBilling();
$ubillingConfig = new UbillingConfig();


/**
 * Branches access control 
 */
$globalAlter = $ubillingConfig->getAlter();
if (@$globalAlter['BRANCHES_ENABLED']) {
    $branchControl = new UbillingBranches();
    $branchControl->accessControl();
}
    
include('api/api.autolader.php');
