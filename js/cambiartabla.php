<?php
require("login_autentica.php");
include("cabezote1.php");
include("cabezote4.php");
$mensaje= "";

$sql="ALTER TABLE `examenes` CHANGE `idexamen` `exa_idexamen` INT(10) NOT NULL AUTO_INCREMENT;";	
 $DB1->Execute($sql);
 
 $sql="ALTER TABLE `examenes` ADD `exa_codigo` VARCHAR(50) NOT NULL AFTER `exa_idexamen`;";	
 $DB1->Execute($sql);
 

$sql3="truncate table `examenes`";	
 $DB1->Execute($sql3); 
 
 $sql2="
INSERT INTO `examenes` (`exa_idexamen`, `exa_codigo`, `exa_nombre`, `exa_tipo`) VALUES
(1, '904925', 'T3 TOTAL', 'matrizlaboratorio'),
(2, '903105', 'ACIDO FOLICO', 'matrizlaboratorio'),
(3, '903801', 'ACIDO URICO', 'matrizlaboratorio'),
(4, '905201', 'ACIDO VALPROICO TECN: QUIMIOLUMINISCENC', 'matrizlaboratorio'),
(5, '906317', 'ACS. ANTIAG.HBs TEC: MICROELISA', 'matrizlaboratorio'),
(6, '', 'ACS. ANTICARDIOLIPINAS IgG TEC: MICROELISA', 'matrizlaboratorio'),
(7, '', 'ACS. ANTICARDIOLIPINAS IgM TEC: MICROELISA', 'matrizlaboratorio'),
(8, '', 'ACS. EPSTEIN BARR IGG TEC:MICROELISA', 'matrizlaboratorio'),
(9, '', 'ACS. EPSTEIN BARR IGM TEC:MICROELISA', 'matrizlaboratorio'),
(10, '903803', 'ALBUMINA', 'matrizlaboratorio'),
(11, '', 'ALFAFETOPROTEINAS TECNICA EIA', 'matrizlaboratorio'),
(12, '903805', 'AMILASA EN SANGRE', 'matrizlaboratorio'),
(13, '904501', 'ANDROSTENEDIONA TEC: RIA', 'matrizlaboratorio'),
(14, '906317', 'ANTI ANTIGENO DE SUPERF. HEPATITIS B', 'matrizlaboratorio'),
(15, '906220', 'ANTI CORE IgM TECNICA: MICROELISA', 'matrizlaboratorio'),
(16, '', 'ANTI CORE TOTAL (ANTI HBc) TEC: MICROELISA', 'matrizlaboratorio'),
(17, '', 'ANTICOAGULANTE LUPICO TEC:DENSIDAD OPTIC', 'matrizlaboratorio'),
(18, '906131', 'ANTICUERPOS ANTI CHAGAS TEC: MICROELISA', 'matrizlaboratorio'),
(19, '906417', 'ANTICUERPOS ANTI DNA INMUNOFLUORESCENCIA', 'matrizlaboratorio'),
(20, '', 'ANTICUERPOS ANTINUCLEARES', 'matrizlaboratorio'),
(21, '', 'ANTICUERPOS ANTITIROIDEOS TIROGLOBULINA', 'matrizlaboratorio'),
(22, '', 'ANTICUERPOS ANTITIROIDEOS-MICROSOMALES', 'matrizlaboratorio'),
(23, '', 'ANTICUERPOS CHLAMYDIA IG G', 'matrizlaboratorio'),
(24, '', 'ANTICUERPOS ENAS TECNICA: MICROELISA', 'matrizlaboratorio'),
(25, '', 'ANTICUERPOS EXTRACTABLE La (EIA)', 'matrizlaboratorio'),
(26, '', 'ANTICUERPOS EXTRACTABLES RNP', 'matrizlaboratorio'),
(27, '', 'ANTICUERPOS EXTRACTABLES SM', 'matrizlaboratorio'),
(28, '906218', 'ANTICUERPOS HEPATITIS A IgM', 'matrizlaboratorio'),
(29, '906219', 'ANTICUERPOS HEPATITIS A TOTAL', 'matrizlaboratorio'),
(30, '906225', 'ANTICUERPOS HEPATITIS C', 'matrizlaboratorio'),
(31, '906241', 'ANTICUERPOS RUBEOLA IgG TEC: MICROELISA', 'matrizlaboratorio'),
(32, '906244', 'ANTICUERPOS RUBEOLA IgM', 'matrizlaboratorio'),
(33, '906001', 'ANTIESTREPTOLISINAS', 'matrizlaboratorio'),
(34, '906603', 'ANTIGENO CARCINOEMBRIONARIO TEC: EIA', 'matrizlaboratorio'),
(35, '906317', 'ANTIGENO DE SUPERFICIE HBsAg', 'matrizlaboratorio'),
(36, '906610', 'ANTIGENO PROSTATICO ESPECIFICO MICROELISA', 'matrizlaboratorio'),
(37, '906611', 'ANTIGENO PROSTATICO LIBRE TEC:EIA', 'matrizlaboratorio'),
(38, '906304', 'ANTIGENOS FEBRILES', 'matrizlaboratorio'),
(39, '', 'BACILOSCOPIA', 'matrizlaboratorio'),
(40, '903809', 'BILIRRUBINAS', 'matrizlaboratorio'),
(41, '906605', 'CA 125 TECNICA: EIA', 'matrizlaboratorio'),
(42, '906606', 'CA 19.9 TECNICA: EIA', 'matrizlaboratorio'),
(43, '', 'CALCIO EN ORINA 24 HORAS', 'matrizlaboratorio'),
(44, '', 'CALCIO EN SANGRE', 'matrizlaboratorio'),
(45, '', 'CELULAS L.E', 'matrizlaboratorio'),
(46, '', 'CETOSTEROIDES 17', 'matrizlaboratorio'),
(47, '906205', 'CITOMEGALOVIRUS IgG', 'matrizlaboratorio'),
(48, '906206', 'CITOMEGALOVIRUS IgM', 'matrizlaboratorio'),
(49, '903818', 'COLESTEROL', 'matrizlaboratorio'),
(50, '903815', 'COLESTEROL HDL', 'matrizlaboratorio'),
(51, '903816', 'COLESTEROL LDL', 'matrizlaboratorio'),
(52, '', 'COLESTEROL VLDL', 'matrizlaboratorio'),
(53, '', 'COLINESTERASA TECNICA : COLORIMETRICA', 'matrizlaboratorio'),
(54, '', 'COMPLEMENTO SERICO 3 TECNICA: IDR', 'matrizlaboratorio'),
(55, '', 'COMPLEMENTO SERICO 4 TECNICA: IDR', 'matrizlaboratorio'),
(56, '890201', 'CONSULTA MEDICINA GENERAL', 'historiaclinica'),
(57, '890202', 'CONSULTA MEDICINA ORTOPEDIA', 'historiaclinica'),
(58, '', 'COOMS DIRECTO', 'matrizlaboratorio'),
(59, '', 'COOMS INDIRECTO', 'matrizlaboratorio'),
(60, '901206', 'COPROCULTIVO', 'matrizlaboratorio'),
(61, '907002', 'COPROLOGICO', 'matrizlaboratorio'),
(62, '', 'COPROSCOPICO', 'matrizlaboratorio'),
(63, '', 'CORTISOL A.M TECNICA: EIA', 'matrizlaboratorio'),
(64, '', 'CORTISOL P.M TECNICA: EIA', 'matrizlaboratorio'),
(65, '', 'CPK MB', 'matrizlaboratorio'),
(66, '', 'CPK TOTAL', 'matrizlaboratorio'),
(67, '903822', 'CREATININA', 'matrizlaboratorio'),
(68, '903824', 'CREATININA EN ORINA', 'matrizlaboratorio'),
(69, '', 'CUADRO HEMATICO COMPLETO', 'matrizlaboratorio'),
(70, '', 'CULTIVO A/B DE ESPUTO', 'matrizlaboratorio'),
(71, '', 'CURVA DE GLICEMIA  5 MUESTRAS', 'matrizlaboratorio'),
(72, '', 'CURVA DE GLICEMIA  7 MUESTRAS', 'matrizlaboratorio'),
(73, '', 'DEHIDROEPIANDROSTERONA SULFATO', 'matrizlaboratorio'),
(74, '', 'DEPURACIÓN DE CREATININA', 'matrizlaboratorio'),
(75, '', 'DESHIDDROGENASA LACTICA', 'matrizlaboratorio'),
(76, '', 'DIMERO D', 'matrizlaboratorio'),
(77, '', 'DOSIFICACION DE VITAMINA B12', 'matrizlaboratorio'),
(78, '', 'ECO MAMARIA', 'matrizlaboratorio'),
(79, '', 'ECO OBSTRETICA', 'matrizlaboratorio'),
(80, '', 'ECO PELVICA', 'matrizlaboratorio'),
(81, '', 'ECO TIROIDES', 'matrizlaboratorio'),
(82, '', 'ECO TRANVAGINAL', 'matrizlaboratorio'),
(83, '', 'ECOABDTOTAL', 'matrizlaboratorio'),
(84, '', 'ELECTROLITO LITIO', 'matrizlaboratorio'),
(85, '', 'ELECTROLITO POTASIO TEC: COLORIMETRICA', 'matrizlaboratorio'),
(86, '', 'ELECTROLITO SODIO TEC: COLORIMETRICA', 'matrizlaboratorio'),
(87, '', 'EOSINOFILOS EN MOCO NASAL', 'matrizlaboratorio'),
(88, '', 'EOSINOFILOS EN SANGRE', 'matrizlaboratorio'),
(89, '', 'ESPERMOGRAMA', 'matrizlaboratorio'),
(90, '', 'ESTRADIOL TECNICA: EIA', 'matrizlaboratorio'),
(91, '', 'FERRITINA TECNICA: EIA', 'matrizlaboratorio'),
(92, '', 'FORMULA LEUCOCITARIA', 'matrizlaboratorio'),
(93, '', 'FOSFATASA ACIDA', 'matrizlaboratorio'),
(94, '', 'FOSFATASA ALCALINA', 'matrizlaboratorio'),
(95, '', 'FOSFORO', 'matrizlaboratorio'),
(96, '', 'FOSFORO EN ORINA DE 24 HORAS', 'matrizlaboratorio'),
(97, '', 'FROTIS CULTIVO ANTIBIOGRAMA', 'matrizlaboratorio'),
(98, '', 'FROTIS CULTIVO ANTIBIOGRAMA DE UNAS', 'matrizlaboratorio'),
(99, '', 'FROTIS CULTIVO ANTIBIOGRAMA S.VAGINAL', 'matrizlaboratorio'),
(100, '', 'FROTIS DE GARGANTA', 'matrizlaboratorio'),
(101, '', 'FROTIS RECTAL', 'matrizlaboratorio'),
(102, '', 'FROTIS SANGRE PERIFERICA', 'matrizlaboratorio'),
(103, '', 'FROTIS SECRECION URETRAL', 'matrizlaboratorio'),
(104, '', 'FROTIS SECRECION VAGINAL', 'matrizlaboratorio'),
(105, '', 'FTA-TP.PA (SERODIA)', 'matrizlaboratorio'),
(106, '', 'GAMA GLUTAMIL TRANSFERASA', 'matrizlaboratorio'),
(107, '', 'GLICEMIA PRE Y POSPRANDIAL', 'matrizlaboratorio'),
(108, '', 'GLICEMIA PREPRANDIAL', 'matrizlaboratorio'),
(109, '', 'GLUCOSURIA', 'matrizlaboratorio'),
(110, '', 'GONADOTROPINA CORIONICA SUB B MICROELISA', 'matrizlaboratorio'),
(111, '', 'GRAM', 'matrizlaboratorio'),
(112, '906023', 'HELICOBACTER PILORY IgG', 'matrizlaboratorio'),
(113, '', 'HEMATOCRITO', 'matrizlaboratorio'),
(114, '911016', 'HEMOCLASIFICACION RH', 'matrizlaboratorio'),
(115, '', 'HEMOGLOBINA GLICOSILADA', 'matrizlaboratorio'),
(116, '', 'HERPES I IgG TECNICA MIROELISA', 'matrizlaboratorio'),
(117, '', 'HERPES I IGM TECNICA MICROELISA', 'matrizlaboratorio'),
(118, '', 'HERPES II IgG TECNICA MICROELISA', 'matrizlaboratorio'),
(119, '', 'HERPES II IgM TECNICA MICROELISA', 'matrizlaboratorio'),
(120, '', 'HIDROXI CORTICOSTEROIDES 17', 'matrizlaboratorio'),
(121, '', 'HIDROXIPROGESTERONA 17 TEC: RIA', 'matrizlaboratorio'),
(122, '', 'HIERRO SERICO TEC:COLORIMETRICA', 'matrizlaboratorio'),
(123, '', 'HISTORIA CLINICA', 'historiaclinica'),
(124, '', 'HORMONA DE CRECIMIENTO BASAL', 'matrizlaboratorio'),
(125, '', 'HORMONA FOLICULO ESTIMULANTE TEC:MEIA', 'matrizlaboratorio'),
(126, '', 'HORMONA LUTEINIZANTE TEC: EIA', 'matrizlaboratorio'),
(127, '', 'HORMONA T4 .', 'matrizlaboratorio'),
(128, '', 'HORMONA TIROESTIMUlANTE tsh', 'matrizlaboratorio'),
(129, '', 'INMUNOGLOBULINA A TEC: IDR', 'matrizlaboratorio'),
(130, '', 'INMUNOGLOBULINA E', 'matrizlaboratorio'),
(131, '', 'INMUNOGLOBULINA G TEC: IDR', 'matrizlaboratorio'),
(132, '', 'INMUNOGLOBULINA M TEC: IDR', 'matrizlaboratorio'),
(133, '', 'INSULINA BASAL TEC: QUIMIOLUMINISCENC', 'matrizlaboratorio'),
(134, '', 'KOH', 'matrizlaboratorio'),
(135, '', 'L.C.R. CITOGUIMICO', 'matrizlaboratorio'),
(136, '', 'LEISHMANIA', 'matrizlaboratorio'),
(137, '', 'MAGNESIO TEC: COLORIMETRICA', 'matrizlaboratorio'),
(138, '', 'MAMOGRAFIA', 'matrizlaboratorio'),
(139, '', 'MICROALBUMINURIA TEC: TURBIDIMETRIA', 'matrizlaboratorio'),
(140, '', 'NITROGENO UREICO', 'matrizlaboratorio'),
(141, '', 'NIVELES DE CARBAMAZEPINA(TEGRETOL)', 'matrizlaboratorio'),
(142, '', 'NIVELES DE EPAMIN(FENITOINA)', 'matrizlaboratorio'),
(143, '', 'PARCIAL DE ORINA', 'matrizlaboratorio'),
(144, '', 'POTASIO URINARIO', 'matrizlaboratorio'),
(145, '', 'PROGESTERONA', 'matrizlaboratorio'),
(146, '', 'PROLACTINA R.I.A', 'matrizlaboratorio'),
(147, '', 'PROTEINA C REACTIVA', 'matrizlaboratorio'),
(148, '', 'PROTEINAS TOTALES', 'matrizlaboratorio'),
(149, '', 'PROTEINEMIA DIFERENCIADA', 'matrizlaboratorio'),
(150, '', 'PROTEINURIA EN ORINA DE 24 H.', 'matrizlaboratorio'),
(151, '890201', 'CONSULTA MEDICA GENERAL ', 'historiaclinica'),
(152, '904508', 'PRUEBA DE EMBARAZO EN SANGRE', 'matrizlaboratorio'),
(153, '906911', 'R.A. TEST', 'matrizlaboratorio'),
(154, '870108', 'RADIOFGHRAFIA DE SNP', 'matrizlaboratorio'),
(155, '871010', 'RADIOGRAFIA DE C.CERVICAL', 'matrizlaboratorio'),
(156, '871020', 'RADIOGRAFIA DE C.DORASAL', 'matrizlaboratorio'),
(157, '871040', 'RADIOGRAFIA DE C.LUMBAR', 'matrizlaboratorio'),
(158, '871060', 'RADIOGRAFIA DE C.TOTAL', 'matrizlaboratorio'),
(159, '873412', 'RADIOGRAFIA DE CADERAS', 'matrizlaboratorio'),
(160, '870001', 'RADIOGRAFIA DE CRANEO', 'matrizlaboratorio'),
(161, '870102', 'RADIOGRAFIA DE ORBITRAS', 'matrizlaboratorio'),
(162, '870107', 'RADIOGRAFIA HPN', 'matrizlaboratorio'),
(163, '', 'RECUENTO DE PLAQUETAS', 'matrizlaboratorio'),
(164, '', 'RECUENTO DE RETICULOCITOS', 'matrizlaboratorio'),
(165, '873122', 'RX ANTEBRAZO', 'matrizlaboratorio'),
(166, '870602', 'RX CAVUN FARINGEO', 'matrizlaboratorio'),
(167, '873121', 'RX DE BRAZO', 'matrizlaboratorio'),
(168, '873312', 'RX DE FEMUR', 'matrizlaboratorio'),
(169, '873210', 'RX DE MANO', 'matrizlaboratorio'),
(170, '873333', 'RX DE MANOS COMPARATIVAS', 'matrizlaboratorio'),
(171, '873333', 'RX DE PIE', 'matrizlaboratorio'),
(172, '873443', 'RX DE PIES COMPARATIVOS', 'matrizlaboratorio'),
(173, '871111', 'RX DE REJA CONSTAL', 'matrizlaboratorio'),
(174, '871121', 'RX DE TORAX', 'matrizlaboratorio'),
(175, '', 'SALUD OCUPACIONAL', 'Saludocupacional'),
(176, '907008', 'SANGRE OCULTA EN MATERIA FECAL', 'matrizlaboratorio'),
(177, '902204', 'SEDIMENTACION GLOBULAR vsg', 'matrizlaboratorio'),
(178, '906916', 'SEROLOGIA VDRL', 'matrizlaboratorio'),
(179, '903864', 'SODIO', 'matrizlaboratorio'),
(180, '904110', 'SOMATOMEDINA C', 'matrizlaboratorio'),
(181, '904923', 'T3 UP TAKE(CAPTACION)R.IA', 'matrizlaboratorio'),
(182, '904921', 'T4 LIBRE', 'matrizlaboratorio'),
(183, '904922', 'T4 NORMALIZADO', 'matrizlaboratorio'),
(184, '904601', 'TESTOSTERONA LIBRE', 'matrizlaboratorio'),
(185, '904602', 'TESTOSTERONA TOTAL', 'matrizlaboratorio'),
(186, '902043', 'TIEMPO DE COAGULACION', 'matrizlaboratorio'),
(187, '902048', 'TIEMPO DE PROTROMBINA', 'matrizlaboratorio'),
(188, '902046', 'TIEMPO DE SANGRIA', 'matrizlaboratorio'),
(189, '902049', 'TIEMPO PARCIAL DE TROMBOPLASTINA', 'matrizlaboratorio'),
(190, '', 'TIROGLOBULINA TEC:QUIMIOLUMINISCEN', 'matrizlaboratorio'),
(191, '906127', 'TOXOPLASMA IgG E.L.I.S.A', 'matrizlaboratorio'),
(192, '906129', 'TOXOPLASMA IgM E.L.I.S.A', 'matrizlaboratorio'),
(193, '903868', 'TRIGLICERIDOS', 'matrizlaboratorio'),
(194, '904924', 'TRIYODOTIRONINA TOTAL T3 TOTAL', 'matrizlaboratorio'),
(195, '903869', 'UREA', 'matrizlaboratorio'),
(196, '901235', 'UROCULTIVO R/C y A/B', 'matrizlaboratorio'),
(197, '906249', 'VIH ELISA', 'matrizlaboratorio'),
(198, '', 'RADIOGRAFIA DE SENOS PARANASALES', 'matrizlaboratorio'),
(199, '870114', 'RADIOGRAFIA PANORAMICA DE MAXILARES, SUPERIOR E INFERIOR ORTOPA', 'matrizlaboratorio'),
(200, '873302', 'RADIOGRAFIA PARA MEDICION DE MIEMBROS INFERIORES  ESTUDIO DE FAR', 'matrizlaboratorio'),
(201, '873424', 'RADIOGRAFIA TANGENCIAL DE ROTULA', 'matrizlaboratorio'),
(202, '873431', 'RADIOGRAFIA DE TOBILLO AP LATERAL Y ROTACION INTERNA', 'matrizlaboratorio'),
(203, '890202', 'CONSULTA DE PRIMERA VEZ POR MEDICINA ESPECIALIZADA', 'matrizlaboratorio'),
(204, '905705', 'ALCOHOL ETILICO EN CUALQUIER MUESTRA POR CROMATOGR', 'matrizlaboratorio'),
(205, '905706', 'ALCOHOL ETILICO EN CUALQUIER MUESTRA POR INMUNOENS', 'matrizlaboratorio'),
(206, '905707', 'ALCOHOL METILICO - FORMALDEHIDO EN CUALQUIER MUEST', 'matrizlaboratorio'),
(207, '905708', 'ALCOHOL METILICO - FORMALDEHIDO EN CUALQUIER MUEST', 'matrizlaboratorio'),
(208, '905727', 'DROGAS DE ABUSO NCOC+', 'matrizlaboratorio')";		
 $DB1->Execute($sql2);

 $sql="SELECT `exa_idexamen`, `exa_codigo`, `exa_nombre`, `exa_tipo` FROM `examenes`    limit 1000 ";		
 $mensaje.= "<option value=''>Seleccione...</option>";
 
 $DB1->Execute($sql);
	//$mensaje.= "<select name='codname' id='codname'>";
	
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
	 $mensaje.= "<option value='$rw1[0]'>$rw1[1]-$rw1[2]</option>";
	}
 
 echo $mensaje;
?>