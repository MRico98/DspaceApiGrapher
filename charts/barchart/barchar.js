window.onload = function(e){
    let xhttp = new XMLHttpRequest();
    xhttp.onload = createBarChar;
    xhttp.open("GET", "http://localhost:9000/api/communities");
    xhttp.send();
}

function createBarChar(e)
{
    let collections = JSON.parse(e.target.response);
    let labels = [];
    let data = [];
    collections.forEach(element => {
        labels.push(element.name);
        data.push(element.countItems);
    });
    console.log(labels);
    console.log(data);
    let myChart = document.getElementById('myChart').getContext('2d');
    let massPopChart = new Chart(myChart, {
        type: 'bar',
        data: {
            labels: labels,
            datasets:[{
                label: 'Population',
                data: data
            }]
        },
        options:{}
    }); 
}