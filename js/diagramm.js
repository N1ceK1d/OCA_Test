function showDiagramm(php_data, id, username, gender = 'Мужчина', company_name = 'Компания') {
    let res_points = [];
    let info = '';
    php_data.map(row => {
        if(gender == 'Мужчина') {
            res_points.push(result_value['man'][row.characteristic_char][row.points])
            info += row.characteristic_char.toUpperCase() + ": " + result_value['man'][row.characteristic_char][row.points] + "\n";
        } else {
            res_points.push(result_value['woman'][row.characteristic_char][row.points])
            info += row.characteristic_char.toUpperCase() + ": " + result_value['woman'][row.characteristic_char][row.points] + "\n";
        }
    })

    new Chart(
        document.querySelector(`.diagramm-item #myChart${id}`),
        {
        type: 'line',
        data: {
            labels: php_data.map(row => row.name.slice(3) + " - " + row.name[0]),
            datasets: [{
                fill: false,
                label: info,
                tension: 0.1,
                data: res_points,
                borderColor: '#0d6efd',
                backgroundColor: '#0d6efd',
            },]
        },
        options: {
            legend: {
                display: true,
            },
            scales: {
                yAxes: [{
                    ticks: {
                      max: 100,
                      min: -100,
                    },
                }],
            },
            title: {
                display: true,
                text: company_name + " -  " + username,
            },
            annotation: {
                annotations: [
                {
                    drawTime: "beforeDatasetsDraw",
                    type: "box",
                    xScaleID: "x-axis-0",
                    yScaleID: "y-axis-0",
                    borderWidth: 0,
                    yMin: 32,
                    yMax: 100,
                    backgroundColor: "rgba(242, 255, 243, 0.67)",
                },{
                    drawTime: "beforeDatasetsDraw",
                    type: "box",
                    xScaleID: "x-axis-0",
                    yScaleID: "y-axis-0",
                    borderWidth: 0,
                    yMin: 5,
                    yMax: 32,
                    backgroundColor: "rgba(224, 255, 225, 0.67)",
                },
                {
                    drawTime: "beforeDatasetsDraw",
                    type: "box",
                    xScaleID: "x-axis-0",
                    yScaleID: "y-axis-0",
                    borderWidth: 0,
                    yMin: -19,
                    yMax: 5,
                    backgroundColor: "rgba(255, 228, 228, 0.67)",
                }, 
                {
                    drawTime: "beforeDatasetsDraw",
                    type: "box",
                    xScaleID: "x-axis-0",
                    yScaleID: "y-axis-0",
                    borderWidth: 0,
                    yMin: -19,
                    yMax: -100,
                    backgroundColor: "rgba(255, 241, 241, 0.67)",
                }]
            }
        }
    });
}

function getKeyByValue(object, value) {
    return Object.keys(object).find(key => object[key] === value);
}
