<main>
    <div class="admin-header">
        THỐNG KÊ
    </div>
    <select name="" id="thongke" onchange="thongke()">
        <option value="hangbanchay">Top 10 sản phẩm có số lượng mua nhiều nhất</option>
        <option value="soluotxem">Top 10 sản phẩm có số lượng xem nhiều nhất</option>
    </select>
    <div>
        <canvas class="myChart"></canvas>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.querySelector('.myChart');

    function thongke() {
        var form_data = new FormData();
        var e = document.querySelector("#thongke")
        form_data.append('name', e.value)
        $.ajax({
            url: "api.php?act=thongke", //Server api to receive the file
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function(res) {
                var chart_x = JSON.parse(res)
                var data_x = {
                    labels: chart_x['label'],
                    datasets: [{
                        label: chart_x['name'],
                        data: chart_x['data'],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        borderWidth: 1
                    }]
                };

                var config_x = {
                    type: 'bar',
                    data: data_x,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };
                mixedChart.destroy()
                mixedChart = new Chart(ctx,
                    config_x
                )
            }
        });
    }

    var data = {
        labels: [],
        datasets: [{
            label: 'My First Dataset',
            data: [],
        }]
    };
    
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    var mixedChart = new Chart(ctx,
        config
    )
    thongke()

</script>