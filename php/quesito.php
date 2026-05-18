<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<div style="max-width: 800px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2rem;">
    <h1 style="color: black;">Dades en Quesito</h1>
    <div style="height: 2px; background: #764ba2; width: 100%; margin: 0.5rem 0 1.5rem 0;"></div>

    <div style="text-align: center;">
        <h2 style="color: black;">Minuts treballats per tècnic</h2>
        <canvas id="q1" width="300" height="300" style="width: 300px; height: 300px; display: inline-block;"></canvas>
    
        <h2 style="color: black; margin-top: 2rem;">Minuts treballats en departament</h2>
        <canvas id="q2" width="300" height="300" style="width: 300px; height: 300px; display: inline-block;"></canvas>

        <br><a href="totes_incidencies.php" style="color: black; display: inline-block; margin-top: 2rem;">Tornar</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
<?php
// Consulta per obtenir minuts totals per cada tecnic
$res = $conn->query("SELECT t.nom, COALESCE(SUM(a.temps_minuts),0) AS total FROM tecnics t LEFT JOIN incidencies i ON t.id_tecnic=i.tecnic_id LEFT JOIN actuacions a ON i.id_inc=a.incidencia_id GROUP BY t.id_tecnic");
$l1=[]; $d1=[];
while($r=$res->fetch_assoc()){ 
    // Filtre, es mostraran les dades que actualment tinguin valors superiors a 0
    if ($r['total'] > 0) {
        $l1[]=$r['nom']; 
        $d1[]=$r['total']; 
    }
}

// Consulta per obtenir minuts totals per cada departament
$res2=$conn->query("SELECT d.nom, COALESCE(SUM(a.temps_minuts),0) AS total FROM departaments d LEFT JOIN incidencies i ON d.id_dept=i.departament_id LEFT JOIN actuacions a ON i.id_inc=a.incidencia_id GROUP BY d.id_dept");
$l2=[]; $d2=[];
while($r=$res2->fetch_assoc()){ 
    // Filtre, es mostraran les dades que actualment tinguin valors superiors a 0
    if ($r['total'] > 0) {
        $l2[]=$r['nom']; 
        $d2[]=$r['total']; 
    }
}
?>

// Creació del grafic de tècnics amb chart.js
new Chart(document.getElementById('q1'),{
    type:'pie',
    data:{labels:<?=json_encode($l1)?>, datasets:[{data:<?=json_encode($d1)?>}]},
    options:{ responsive: false, maintainAspectRatio: false, plugins:{legend:{display:true, position:'right'}}}
});

// Creació del grafic de departaments amb chart.js
new Chart(document.getElementById('q2'),{
    type:'pie',
    data:{labels:<?=json_encode($l2)?>, datasets:[{data:<?=json_encode($d2)?>}]},
    options:{ responsive: false, maintainAspectRatio: false, plugins:{legend:{display:true, position:'right'}}}
});
</script>

<?php include 'footer.php'; ?>