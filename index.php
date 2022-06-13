
	
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" style="position:absolute;width:25px;height:35px;top:0px;" />
		<!--Title-->
		<title>E - PTK Dikmen dan Diksus</title>
	<!DOCTYPE <!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="suite_gpl/codebase/suite.js"></script>
	<link rel="stylesheet" type="text/css" href="suite_gpl/codebase/suite.css"/>
	<link rel="stylesheet" href="suite_gpl/common/index.css">
	<!-- custom sample head -->
	<link href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css?v=6.5.1" media="all" rel="stylesheet" type="text/css">
	<style>
		.bg-gray, .dhx_toolbar {
			background: #efefef;
		}
	</style>
</head>
<body>
	<section class="dhx_sample-container">
		<div class="dhx_sample-container__widget" id="layout"></div>
	</section>
	<script>
	var tahun = "22";
	var semester = "01";
	var jumlah_kasus = "13";
	const configLogin = {
		type: "line",
		rows: [
			{
				id: "form1"
			},
			{
				html: "<img src='captcha/captcha.php?rand=673169342' id='captchaimg'><a href='javascript: refreshCaptcha();'><span class=reload>&#x21bb;</span> Refresh</a>"
			},
			{
				id: "form2"
			}
		]
	};

	const layoutLogin = new dhx.Layout(null, configLogin);
	var form1 = new dhx.Form(null, {
		css: "bg-gray",
		rows: [
			{
				type: "input",
				required: true,
				label: "Username",
				id: "username",
				icon: "dxi dxi-eye",
				placeholder: "Username",
				preMessage: "Input Username",
				successMessage: "Input berhasil...",
				errorMessage: "Input gagal...",
				labelPosition: "left"
			},
			{
				type: "input",
				required: true,
				inputType:'password',
				label: "Password",
				id: "password",
				icon: "dxi dxi-eye-off",
				placeholder: "Password",
				preMessage: "Input Password",
				successMessage: "Input berhasil...",
				errorMessage: "Input gagal...",
				labelPosition: "left"
			},
			{
				type: "input",
				required: true,
				label: "Security Code.",
				id: "captcha_code",
				icon: "dxi dxi-eye",
				placeholder: "Enter Security Code.",
				preMessage: "Enter Security Code.",
				successMessage: "Input berhasil...",
				errorMessage: "Security Code tidak valid...",
				labelPosition: "left"
			}
		]
	});
	layoutLogin.getCell("form1").attach(form1);
	var form2 = new dhx.Form(null, {
		css: "bg-gray",
		cols: [
			{
				type: "button",
				id: "lupa",
				value: "Lupa Password",
				icon: "dxi dxi-information-outline", 
				size: "small",
				view: "flat",
				color: "danger"
			},
			{},
			{
				type: "button",
				id: "login",
				value: "Login",
				icon: "dxi dxi-key",
				submit: true,
				size: "medium",
				view: "flat",
				color: "primary"
			}
		]
	});
	layoutLogin.getCell("form2").attach(form2);
	var formLupa = new dhx.Form(null, {
		css: "dhx_widget--bordered",
		rows: [
			{
				type: "input",
				required: true,
				label: "Username",
				labelWidth: "75px",
				id: "username",
				icon: "dxi dxi-eye",
				placeholder: "Username",
				preMessage: "Input Username",
				successMessage: "Input Berhasil...",
				errorMessage: "Input Gagal...",
				labelPosition: "left"
			},
			{ 
				type: "input", 
				label: "Email", 
				labelWidth: "75px",
				id:"email",
				placeholder: "jd@mail.name",
				errorMessage: "Invalid email",
				successMessage: "Valid email",
				validation: "email",
				labelPosition: "left"
			},
			{
				type: "button",
				value: "Send",
				icon: "dxi dxi-blur",
				submit: true,
				size: "medium",
				view: "flat",
				color: "primary"
			}
		]
	});
	form2.events.on("Click", function(id,e){
		if (id=="lupa") {
			var dhxWindow = new dhx.Window({width: 440, height: 300, title: "Lupa Password", closable: true, modal:true});
			dhxWindow.attach(formLupa)
			dhxWindow.show();
			formLupa.events.on("Click", function(id,e){
				var username = formLupa.getItem("username").getValue();
				var email = formLupa.getItem("email").getValue();
				var param = "?";
				param += "dhxform_username="+ username; param += "&";
				param += "email="+ email;	//param += "&";
				if (formLupa.validate()){
					formLupa.send("reset.php"+ param).then(function(r) {
						r = JSON.parse(r);
						if (r.status == 1) {
							dhx.message({
								text:"Reset Success Check Email", 
								icon:"dxi-clock", 
								css:"expire", 
								expire:1000
							});
							setTimeout(function(){
							  window.location.reload();
							});
						} 
						if (r.status == 2) {
							dhx.message({
								text:"Something went wrong!",
								css:"dhx_message--error",
								icon:"dxi-close",
								expire:1000
							});
						} 
						if (r.status == 3) {
							dhx.message({
								text:"Email belum terdaftar,..",
								css:"dhx_message--error",
								icon:"dxi-close",
								expire:1000
							});
						} 			
					});
				}
			});					
		}
		if (id=="login") {
			if (form1.validate()){
				var dhxform_username = form1.getItem("username").getValue();
				var dhxform_pwd = form1.getItem("password").getValue();
				var captcha_code = form1.getItem("captcha_code").getValue();
				var param = "?";
				param += "dhxform_username="+ dhxform_username; param += "&";
				param += "dhxform_pwd="+ dhxform_pwd; param += "&";
				param += "captcha_code="+ captcha_code;	//param += "&";
				form1.send("check.php"+ param).then(function(r) {
					r = JSON.parse(r);
					if (r.status == 1) {
						dhx.message({
							text:"Login Succes...", 
							icon:"dxi-clock", 
							css:"expire", 
							expire:1000
						});
						parent.location.href = "modul/nav.php";
					} 
					if (r.status == 2) {
						dhx.message({
							text:"Username/Password salah...",
							css:"dhx_message--error",
							icon:"dxi-close",
							expire:1000
						});
					}
					if (r.status == 3) {
						dhx.message({
							text:"Security Code salah,..",
							css:"dhx_message--error",
							icon:"dxi-close",
							expire:1000
						});
					}
				});
			}
		}
	});
	var config = {
		css: "dhx_layout-cell--bordered",
		height: "content",
		rows: [
			{
				html: "<MARQUEE align='center' direction='left' scrollamount='3'>Silahkan klik Link survei mengenai aplikasi data guru <a href='https://esurya.organisasi.jatengprov.go.id/edatagurudisdikbud' target='_blank'>Survey ESURYA</a></MARQUEE>"
			},
			{
				html: "<header class='dhx_sample-header'>"+
						"<div class='dhx_sample-header__main'>"+
							"<nav class='dhx_sample-header__breadcrumbs'>"+
								"<ul class='dhx_sample-header-breadcrumbs'>"+
									"<li class='dhx_sample-header-breadcrumbs__item'>"+
										"<span class='dhx_sample-header-breadcrumbs__link'><img src='images/logo.png' style='position:absolute;width:auto;height:40px;margin-top:-10px;'><span style='margin-left:40px;'>-</span></span>"+
									"</li>"+
									"<li class='dhx_sample-header-breadcrumbs__item'>"+
										"<span class='dhx_sample-header-breadcrumbs__link'>E - PTK Dikmen dan Diksus</span>"+
									"</li>"+
									"<li class='dhx_sample-header-breadcrumbs__item'>"+
										"<span class='dhx_sample-header-breadcrumbs__link'>20"+tahun+"</span>"+
									"</li>"+
									"<li class='dhx_sample-header-breadcrumbs__item'>"+
										"<span class='dhx_sample-header-breadcrumbs__link'>SMT "+semester+"</span>"+
									"</li>"+
								"</ul>"+
							"</nav>"+
							"<div style='display: flex; justify-content: flex-end'>"+
								"<ul class='dhx_sample-header-breadcrumbs'>"+
									"<li class='dhx_sample-header-breadcrumbs__item'>"+
										"<button id='login' class='dhx_sample-btn dhx_sample-btn--flat'><img src='images/login.png' style='width:auto;height:20px;'>Login</button>"+
									"</li>"+
								"</ul>"+
							"</div>"+
						"</div>"+
					"</header>",
				css: "dhx_layout-cell--border_bottom"
			},
			{
				html: "<br><br><MARQUEE align='center' direction='left' scrollamount='3'>Kasus Covid-19 selama sebulan terakhir sebanyak "+jumlah_kasus+" kasus pendataan data kasus covid-19 ada di menu sekolah kemudian di Data Kasus Covid-19 update selalu baik ada kasus maupun tidak ada kasus <B><i>..::: Mari wujudkan data yang berkualitas, valid, dan akuntabel :::..<B><i>"+
					"</MARQUEE>"
			},
			{	
				height: "350px",
				cols: [
					{
						width: "50%",
						header: "Kasus Covid sebulan terakhir",
						html: "<div class='dhx_sample-container__widget' id='chart1'></div>"
					},
					{
						header: "Laporan tidak ada kasus sebulan terakhir",
						html: "<div class='dhx_sample-container__widget' id='chart2'></div>"
					}
				]
			},
			{	
				height: "350px",
				cols: [
					{
						width: "30%",
						header: "Sekolah dan Cabdin",
						html: "<div class='dhx_sample-container__widget' id='chart3'></div>"
					},
					{
						width: "35%",
						header: "Sekolah",
						html: "<div class='dhx_sample-container__widget' id='chart4'></div>"
					},
					{
						header: "Cabdin dan Induk",
						html: "<div class='dhx_sample-container__widget' id='chart5'></div>"
					}
				]
			},
			{
				html: "<br><br><b><center>LAYANAN INFORMASI UMUM DAN KEPEGAWAIAN DISDIKBUD PROV. JATENG.</center></b><br>"},
			{
				id: "dataview"
			},
			{
				id: "footer",
				html : "<center>&copy; <a href='http://pdk.jatengprov.go.id' target='blank'>Disdikbud Provinsi Jateng.</a> &reg. Team ICT 2018. version 1.2 &#x1F6C8; <button class='dhx_sample-btn--flat' id='show'>About</button></center>",
				css: "dhx_layout-cell--border_top",
				gravity: false
			}
		]
	};
	var layout = new dhx.Layout("layout", config);
	function template(item) {
		var template = "<div class='item_wrap'>";
		template += "<h2 class='title'>" + item.value + "</h2>";
		template += "<p class='description'>" + item.shortDescription + "</p>";
		template += "</div>";
		return template;
	}
	
	const config1 = {
		type:"area",
		scales: {
			"bottom" : {
				text: "minggu",
				title: "Tanggal Input",
				scaleRotate: -45
			},
			"left" : {
				maxTicks: 10,
				min: 0
			}
		},
		series: [
			{
				id: "A",
				value: "Meninggal Dunia",
				color: "#9A8BA5",
				pointType: "rect"
			},
			{
				id: "B",
				value: "Masih Perawatan",
				color: "#EEB98E",
				pointType: "triangle"
			},
			{
				id: "C",
				value: "Sembuh",
				color: "#5E83BA",
				pointType: "circle"
			}
		],
		legend: {
			series: ["A", "B", "C"],
			halign: "right",
			valign: "top"
		}
	};

	const chart1 = new dhx.Chart("chart1", config1);
	chart1.data.load("data/data1.php");

	const config2 = {
		type:"area",
		scales: {
			"bottom" : {
				text: "minggu",
				title: "Tanggal Input",
				scaleRotate: -45
			},
			"left" : {
				maxTicks: 10,
				min: 0
			}
		},
		series: [
			{
				id: "A",
				value: "SMA",
				color: "#81C4E8",
				pointType: "rect"
			},
			{
				id: "B",
				value: "SMK",
				color: "#74A2E7",
				pointType: "triangle"
			},
			{
				id: "C",
				value: "SLB",
				color: "#5E83BA",
				pointType: "circle"
			}
		],
		legend: {
			series: ["A", "B", "C"],
			halign: "right",
			valign: "top"
		}
	};

	const chart2 = new dhx.Chart("chart2", config2);
	chart2.data.load("data/data2.php");

	const config3 = {
		type: "bar",
		css: "dhx_widget--bg_white dhx_widget--bordered",
		scales: {
			"bottom": {
				text: "progres_penanganan",
				scaleRotate: -15
			},
			"left": {
				maxTicks: 10,
				min: 0
			}
		},
		series: [
			{
				id: "A",
				value: "SMA",
				color: "#81C4E8",
				stacked: true,
				fill: "#81C4E8"
			},
			{
				id: "B",
				value: "SMK",
				color: "#74A2E7",
				stacked: true,
				fill: "#74A2E7"
			},
			{
				id: "C",
				value: "SLB",
				color: "#5E83BA",
				stacked: true,
				fill: "#5E83BA"
			},
			{
				id: "D",
				value: "CABDIN",
				color: "#394E79",
				stacked: true,
				fill: "#394E79"
			}
		],
		legend: {
			series: ["A", "B", "C", "D"],
			halign: "left",
			valign: "bottom"
		}
	};

	const chart3 = new dhx.Chart("chart3", config3);
	chart3.data.load("data/data3.php");

	const config4 = {
		type: "pie3D",
		css: "dhx_widget--bg_white dhx_widget--bordered",
		series: [
			{
				value: "value",
				text: "id",
				stroke: "#FFFFFF",
				strokeWidth: 2
			}
		],
		legend: {
			values: {
				id: "value",
				text: "id"
			},
			halign: "left",
			valign: "bottom"
		}
	};

	const chart4 = new dhx.Chart("chart4", config4);
	chart4.data.load("data/data4.php");

	const config5 = {
		type: "pie3D",
		css: "dhx_widget--bg_white dhx_widget--bordered",
		series: [
			{
				value: "value",
				text: "id",
				stroke: "#FFFFFF",
				strokeWidth: 2
			}
		],
		legend: {
			values: {
				id: "value",
				text: "id"
			},
			halign: "left",
			valign: "bottom"
		}
	};

	const chart5 = new dhx.Chart("chart5", config5);
	chart5.data.load("data/data5.php");

	var dataview = new dhx.DataView(null, {
		css: "dhx_widget--bordered",
		itemsInRow: 3,
		gap: 10,
		template: template,
		data: [
				{
					"value": "1. Kenaikan Pangkat",
					"shortDescription": "a. Kenaikan Pangkat Reguler JFU <a href='#' onclick='doSomething(\"a. Kenaikan Pangkat Reguler JFU\",\"TCPDF-master/cetak/kp_reguler.php\");'>Download</a><br>"+
										"b. Kenaikan Pangkat Struktural <a href='#' onclick='doSomething(\"b. Kenaikan Pangkat Struktural\",\"TCPDF-master/cetak/kp_struktural.php\");'>Download.</a><br>"+
										"c. Kenaikan Pangkat JFT <a href='#' onclick='doSomething(\"c. Kenaikan Pangkat JFT\",\"TCPDF-master/cetak/kp_jft.php\");'>Download.</a><br>"+
										"d. Kenaikan Pangkat Penyesuaian Ijazah <a href='#' onclick='doSomething(\"d. Kenaikan Pangkat Penyesuaian Ijazah\",\"TCPDF-master/cetak/kp_pi.php\");'>Download.</a><br>"+
										"e. Kenaikan Pangkat Anumerta <a href='#' target='blank'>Download.</a>",
				},
				{
					"value": "2. Pensiun",
					"shortDescription": "a. Kelengkapan Berkas Hardcopy Pensiun Atas Permintaan Sendiri (Pensiun Dini) <a href='#' onclick='doSomething(\"a. Kelengkapan Berkas Hardcopy Pensiun Atas Permintaan Sendiri (Pensiun Dini)\",\"TCPDF-master/cetak/pensiun_dini.php\");'>Download.</a><br>"+
										"b. Kelengkapan Berkas Hardcopy Janda/Duda/Yatim <a href='#' onclick='doSomething(\"b. Kelengkapan Berkas Hardcopy Janda/Duda/Yatim\",\"TCPDF-master/cetak/pensiun.php\");'>Download.</a><br>"+
										"c. Kelengkapan Berkas Hardcopy Pensiun BUP <a href='#' onclick='doSomething(\"c. Kelengkapan Berkas Hardcopy Pensiun BUP\",\"TCPDF-master/cetak/bup.php\");'>Download.</a>",
				},
				{
					"value": "3. Ralat SK",
					"shortDescription": "a. Ralat SK <a href='#' target='blank'>Download.</a>",
				},
				{
					"value": "4. Ijin Belajar",
					"shortDescription": "a. Syarat Berkas Ijin Belajar <a href='#' onclick='doSomething(\"a. Syarat Berkas Ijin Belajar\",\"TCPDF-master/cetak/ijin_belajar.php\");'>Download.</a><br>"+
										"b. Tugas Belajar <a href='#' onclick='doSomething(\"b. Tugas Belajar\",\"http://bkd.jatengprov.go.id/new/article/view/605\");'>Download.</a>",
				},
				{
					"value": "5. Cuti",
					"shortDescription": "a. Cuti Tahunan <a href='#' onclick='doSomething(\"a. Cuti Tahunan\",\"TCPDF-master/cetak/cuti.php\");'>Download.</a><br>"+
										"b. Cuti Alasan Penting <a href='#' onclick='doSomething(\"b. Cuti Alasan Penting\",\"TCPDF-master/cetak/cuti.php\");'>Download.</a><br>"+
										"c. Cuti diluar Tanggungan Negara <a href='#' onclick='doSomething(\"c. Cuti diluar Tanggungan Negara\",\"TCPDF-master/cetak/cuti.php\");'>Download.</a><br>"+
										"d. Cuti Bersalin <a href='#' onclick='doSomething(\"d. Cuti Bersalin\",\"TCPDF-master/cetak/cuti.php\");'>Download.</a><br>"+
										"e. Cuti Besar <a href='#' onclick='doSomething(\"e. Cuti Besar\",\"TCPDF-master/cetak/cuti.php\");'>Download.</a>",
				},
				{
					"value": "6. Sumpah Janji PNS",
					"shortDescription": "a. Sumpah Janji PNS <a href='#' onclick='doSomething(\"a. Sumpah Janji PNS\",\"TCPDF-master/cetak/sumpah_janji.php\");'>Download.</a>",
				},
				{
					"value": "7. Kenaikan Gaji Berkala",
					"shortDescription": "a. Kenaikan Gaji Berkala <a href='#' onclick='doSomething(\"a. Kenaikan Gaji Berkala\",\"TCPDF-master/cetak/gaji_berkala.php\");'>Download.</a>",
				},
				{
					"value": "8. Mutasi",
					"shortDescription": "a. Mutasi <a href='#' target='blank'>Download.</a>",
				},
				{
					"value": "9. Ijin Penggunaan Gelar",
					"shortDescription": "a. Ijin Penggunaan Gelar <a href='#' onclick='doSomething(\"a. Ijin Penggunaan Gelar\",\"http://bkd.jatengprov.go.id/new/article/view/511\");'>Download.</a>",
				},
				{
					"value": "10. Pembuatan Kartu Pegawai (KARPEG)",
					"shortDescription": "a. Pembuatan Kartu Pegawai (KARPEG) <a href='#' onclick='doSomething(\"a. Pembuatan Kartu Pegawai (KARPEG)\",\"TCPDF-master/cetak/karpeg.php\");'>Download.</a>",
				},
				{
					"value": "11. Pembuatan Karis/Karsu",
					"shortDescription": "a. Pembuatan Karis/Karsu <a href='#' onclick='doSomething(\"a. Pembuatan Karis/Karsu\",\"TCPDF-master/cetak/karis_karsu.php\");'>Download.</a>",
				},
				{
					"value": "12. Ujian Kenaikan Pangkat Penyesuaian Ijazah",
					"shortDescription": "a. Ujian Kenaikan Pangkat Penyesuaian Ijazah <a href='#' target='blank'>Download.</a>",
				},
				{
					"value": "13. Taspen",
					"shortDescription": "a. Taspen <a href='#' onclick='doSomething(\"a. Taspen\",\"TCPDF-master/cetak/taspen.php\");'>Download.</a>",
				},
				{
					"value": "14. JKK",
					"shortDescription": "a. JKK <a href='#' target='blank'>Download.</a>",
				},
				{
					"value": "15. Ujian Dinas",
					"shortDescription": "a. Ujian Dinas <a href='#' target='blank'>Download.</a>",
				},
				{
					"value": "16. Satyalancana",
					"shortDescription": "a. Satyalancana <a href='#' onclick='doSomething(\"a. Satyalancana\",\"TCPDF-master/cetak/satyalancana.php\");'>Download.</a>",
				},
				{
					"value": "17. JFT",
					"shortDescription": "a. Pengangkatan Pertama kali dalam Jabatan Fungsional Guru <a href='#' onclick='doSomething(\"a. Pengangkatan Pertama kali dalam Jabatan Fungsional Guru\",\"TCPDF-master/cetak/pk_jftguru.php\");'>Download.</a><br>"+
										"b. Kenaikan Jabatan(Guru Muda, Guru Madya, Guru Utama) <a href='#' target='blank'>Download.</a>",
				},
				{
					"value": "18. Ijin Cerai",
					"shortDescription": "a. Tergugat <a href='#' onclick='doSomething(\"a. Tergugat\",\"TCPDF-master/cetak/perceraian_tergugat.php\");'>Download.</a><br>"+
										"b. Penggugat <a href='#' onclick='doSomething(\"b. Penggugat\",\"TCPDF-master/cetak/perceraian_penggugat.php\");'>Download.</a>",
				}
		]
	});
	layout.getCell("dataview").attach(dataview);
	dataview.data.map(function (item, i) {
		if (i % 2) {
			dataview.data.update(item.id, {css: "bg-gray"})
		}
	});

	var popup = new dhx.Popup({
		css: "dhx_widget--border-shadow"
	});
	document.querySelector("#login").addEventListener("click", function (){
		popup.attach(layoutLogin);
		popup.show("login");
	});
	function doSomething(namaDoc, url){
		var windowHTML = '<iframe src="'+url+'" frameborder="0" style="overflow-y:scroll !important; overflow-x:hidden !important; min-height:600px !important;overflow:hidden;height:100%;width:100%;" scrolling="yes"></iframe>';
		var dhxWindow = new dhx.Window({title: namaDoc, header: true, footer: true, resizable: true, closable: true, modal: true, html: windowHTML});
		dhxWindow.header.data.add({icon: "mdi mdi-fullscreen", id: "fullscreen"}, 2);
		var isFullScreen = false;
		var oldSize = null;
		var oldPos = null;
		dhxWindow.header.events.on("click", function(id) {
			if (id === "fullscreen") {
				if (isFullScreen) {
					dhxWindow.setSize(oldSize.width, oldSize.height);
					dhxWindow.setPosition(oldPos.left, oldPos.top);
				} else {
					oldSize = dhxWindow.getSize();
					oldPos = dhxWindow.getPosition();
					dhxWindow.setFullScreen();
				}
				isFullScreen = !isFullScreen;
			}
		});
		dhxWindow.show();
	}
	function refreshCaptcha(){
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}
	var popupAbaout = new dhx.Popup({
		css: "dhx_widget--border-shadow"
	});
	popupAbaout.attachHTML("<b>e - Data Guru Pendidikan Menengah dan Pendidikan Kusus:</b><br>Adalah Aplikasi berbasis web yang sumber data awal berasal dari Satuan Pendidikan dan PDSP KEMDIKBUD. Aplikasi ini bertujuan untuk memberikan informasi kebutuhan guru jenjang SMA, SMK, dan Diksus di Provinsi Jawa Tengah guna meningkatkan pelayanan mutu pendidikan yang lebih baik lagi.");
	document.querySelector("#show").addEventListener("click", function () {
		popupAbaout.show("show");
	});
	</script>
</body>
</html>