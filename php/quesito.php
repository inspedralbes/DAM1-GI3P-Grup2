<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<h1>Estadístiques</h1>

<div style="max-width: 900px; margin: 2rem auto; background: white; padding: 2rem; text-align: center; color: black;">

    <h2>Minuts treballats per tècnic</h2>
    <canvas id="q1" width="250" height="250" style="max-width:250px; margin:0 auto;"></canvas>

    <h2>Minuts treballats en departament</h2>
    <canvas id="q2" width="250" height="250" style="max-width:250px; margin:0 auto;"></canvas>

    <br><a href="totes_incidencies.php">Tornar</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
<?php
$res = $conn->query("SELECT t.nom, COALESCE(SUM(a.temps_minuts),0) AS total FROM tecnics t LEFT JOIN incidencies i ON t.id_tecnic=i.tecnic_id LEFT JOIN actuacions a ON i.id_inc=a.incidencia_id GROUP BY t.id_tecnic");
$l1=[]; $d1=[];
while($r=$res->fetch_assoc()){ $l1[]=$r['nom']; $d1[]=$r['total']; }

$res2=$conn->query("SELECT d.nom, COALESCE(SUM(a.temps_minuts),0) AS total FROM departaments d LEFT JOIN incidencies i ON d.id_dept=i.departament_id LEFT JOIN actuacions a ON i.id_inc=a.incidencia_id GROUP BY d.id_dept");
$l2=[]; $d2=[];
while($r=$res2->fetch_assoc()){ $l2[]=$r['nom']; $d2[]=$r['total']; }
?>

new Chart(document.getElementById('q1'),{type:'pie',data:{labels:<?=json_encode($l1)?>,datasets:[{data:<?=json_encode($d1)?>}]},options:{plugins:{legend:{display:false}}}});
new Chart(document.getElementById('q2'),{type:'pie',data:{labels:<?=json_encode($l2)?>,datasets:[{data:<?=json_encode($d2)?>}]},options:{plugins:{legend:{display:false}}}});
</script>

<?php include 'footer.php'; ?>