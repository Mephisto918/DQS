// // Set the dimensions of the graph
// const margin = { top: 20, right: 20, bottom: 30, left: 50 },
    //   width = 400 - margin.left - margin.right, // Adjust width of the graph
    //   height = 230 - margin.top - margin.bottom; // Adjust height of the graph

// Create SVG container
const svg_day = d3.select("#chartday")
              .attr("width", width + margin.left + margin.right)
              .attr("height", height + margin.top + margin.bottom)
              .append("g")
              .attr("transform", `translate(${margin.left},${margin.top})`);
// -------------------------------------------------------------------------------------------------------------
// draw chart
function draw_chart_day(data) {
    // Clear previous content
    svg_day.selectAll("*").remove();

    // Convert data to the format needed for the bar chart
    const formattedData = data.map((d, i) => ({ x:i, y: d }));
    const x_values = ['9', '11', '1', '3', '5', '7', '9'];

    // Set the scales
    const x = d3.scaleBand()
                .domain(x_values)
                .range([0, width]) // Adjust range of x-axis
                .padding(0.1); // Adjust padding between bars

    const yMax = d3.max(formattedData, d => d.y);
    const y = d3.scaleLinear()
                .domain([0, yMax]) // Adjust domain of y-axis
                .range([height, 0]); // Adjust range of y-axis

    // Add x-axis
    svg_day.append("g")
       .attr("transform", `translate(0,${height})`)
       .call(d3.axisBottom(x)); // Format the x-axis ticks

    // Add the y-axis
    svg_day.append("g")
       .call(d3.axisLeft(y)); // Format the y-axis ticks

    // Add the bars
    svg_day.selectAll(".bar")
       .data(formattedData)
       .enter().append("rect")
       .attr("class", "bar")
       .attr("x", (d, i) => x(x_values[i])) // Set the x position of the bar
       .attr("y", d => y(d.y)) // Set the y position of the bar
       .attr("width", x.bandwidth()) // Set the width of the bar
       .attr("height", d => height - y(d.y)) // Set the height of the bar
       .attr("fill", "white"); // Set the color of the bar
}

// Fetch data and draw the chart
function run_chart_day(){
    fetch('./report/test.php')
    .then(response => response.json())
    .then(data => {
        draw_chart_day(data); // Draw the chart with the fetched data
        // console.log(data); // Log the data to the console
    })
    .catch(error => console.error('Error fetching data:', error)) // Handle any errors
}

// Set the interval to fetch data every 2 seconds
// run_chart_day();
// setInterval(run_chart_day, 50); 
