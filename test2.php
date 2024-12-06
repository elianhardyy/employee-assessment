<script>
      
      //const sessionDashboard = document.getElementById("session-dashboard");
                      const ctx2 = document.getElementById("myChartKoorProduksi").getContext('2d')
                      console.log("ini produksi")
                      const arrDataScoreKoorProduksi = []
                      const bulanDataKoorProduksi = []
                      const dataFramePHPKoorProduksi = <?php echo $dataProduksijson ?>
                      //console.log(dataFramePHPKoorProduksi)
                      const koorProduksi = dataFramePHPKoorProduksi.reduce((acc,item)=>{
                        if(!acc[item.id_periode_bulan_fk]){
                          acc[item.id_periode_bulan_fk] = {total:0, count:0}
                        }
                        acc[item.id_periode_bulan_fk].total += Number(item.nilai_akhir)
                        acc[item.id_periode_bulan_fk].count += 1;
                      },{})
                      const averagePerMonthKoorProduksi = Object.keys(koorProduksi).map(bulan=>({
                        bulan: parseInt(bulan),
                        rataRata : koorProduksi[bulan].total / koorProduksi[bulan].count
                      }))
                      const dataKoorProduksi = averagePerMonthKoorProduksi.forEach((v,i)=>{
                        arrDataScoreKoorProduksi.push(v.rataRata)
                        const bulanKata = angkaKeBulan(v.bulan)
                        bulanDataKoorProduksi.push(bulanKata)
                      })
                      const chartProd = new Chart(ctx2,{
          type : 'bar',
          data : {
            labels: bulanDataKoorProduksi,
            datasets : [
              {
                label:"Produksi",
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                data:arrDataScoreKoorProduksi
              },
              
            ]
          },
          options :{
            scales :{
              y:{
                beginAtZero: true,
                ticks: {
                            max: 100, // Memastikan nilai maksimum Y adalah 100
                            stepSize: 10 // Mengatur interval sumbu Y
                        }
              }
            },
            responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
          }
        })
                </script>