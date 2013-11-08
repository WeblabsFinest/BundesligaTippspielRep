<?php
	require_once '../../../Scripts/php/constant.php';
    require_once HOME_PHP."Controllers/UserController.php";
	require_once HOME_PHP."Models/User.php";
	if(isset($_POST['lock'])){
		UserController::lockUser($_POST['email']);
	}else if(isset($_POST['activate'])){
		UserController::activateUser($_POST['email']);
	}else if(isset($_POST['delete'])){
		UserController::deleteUser($_POST['email']);
	}else if(isset($_POST['passwordReset'])){
		UserController::resetPassword($_POST['email']);
	}

	$users = UserController::getAllUsers();

?>
<div id="userAdministration">
	<h2>Benutzer Verwaltung</h2>
	<script>
	$( document ).ready(function() {
		$("#userGrid").jqGrid({
			url: "http://localhost/BuLiTippspiel/Controllers/UserController.php?getUsersJson",
			datatype: "json",
			mType: "GET",
			width: 900,
			rowheight: 30,
			height: "auto",
			colNames: ["E-Mail", "Benutzername", "Rolle", "Aktiv", "Verwaltung"],
			colModel: [
				{ name: "email", width: 247, search:true, stype:'text'},
				{ name: "username", width: 238, search:true, stype:'text'},
				{ name: "role", width: 100, search:true, stype:'text'},
				{ name: "active", width: 50, search:true, stype:'text'},
				{ name: "controll", width: 140, search: false,
					formatter: function(rowId, value, rowObject, colModel, arrData) { return rowId}}
			],
			rowNum: 10,
			rowList: [10,20,30],
			pager: "#pagerUser",
			sortorder: "desc",
			viewrecords: true,
			gridview: true,
			autoencode: true,
			loadonce: true,
			sortable: true,
			ignoreCase: true
		});
		   jQuery("#userGrid").jqGrid('navGrid', '#pagerUser', { add: false, edit: false, del: false },{}, {}, {},
                { multipleSearch: true, overlay: false });
            jQuery("#userGrid").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: true, defaultSearch: 'cn' });
            jQuery("#userGrid").jqGrid('navButtonAdd', '#pagerUser',
                {
                    caption: "Filter",
                    title: "Toggle Searching Toolbar",
                    buttonicon: 'ui-icon-pin-s',
                    onClickButton: function () {
                        jQuery("#userGrid")[0].toggleToolbar();
                    }
                }
            );
            jQuery("#userGrid")[0].toggleToolbar();
		
	});
	</script>
	<table id="userGrid"></table>
	<div id="pagerUser"></div>
</div>
