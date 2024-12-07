// // Set the dimensions of the graph
const margin = { top: 20, right: 20, bottom: 30, left: 50 },
      width = 400 - margin.left - margin.right, // Adjust the width of the graph
      height = 230 - margin.top - margin.bottom; // Adjust the height of the graph

// Create the SVG container
const svg_week = d3.select("#chartweek")
              .attr("width", width + margin.left + margin.right)
              .attr("height", height + margin.top + margin.bottom)
              .append("g")
              .attr("transform", `translate(${margin.left},${margin.top})`);

// Function to draw the chart
function draw_chart_week(data) {
    // Clear previous content
    svg_week.selectAll("*").remove();

    // Convert data to the format needed for the bar chart
   //  const formattedData = data.map((d, i) => ({ y: i}));
    const x_values = ['9', '11', '1', '3', '5', '7'];

    // Set the scales
    const x = d3.scaleBand(x_values)
                .domain(formattedData.map(d => d.x))
                .range([0, width]) // Adjust the range of the x-axis
                .padding(0.1); // Adjust the padding between bars

    const yMax = d3.max(data, d => d.count);
    const y = d3.scaleLinear()
                .domain([0, yMax || 0]) // Adjust the domain of the y-axis
                .range([height, 0]); // Adjust the range of the y-axis

    // Add the x-axis
    svg_week.append("g")
       .attr("transform", `translate(0,${height})`)
       .call(d3.axisBottom(x).tickFormat(i => i + 1)); // Format the x-axis ticks

    // Add the y-axis
    svg_week.append("g")
       .call(d3.axisLeft(y)); // Format the y-axis ticks

    // Add the bars
    svg_week.selectAll(".bar")
       .data(formattedData)
       .enter().append("rect")
       .attr("class", "bar")
       .attr("x", d => x(d.x)) // Set the x position of the bar
       .attr("y", d => y(d.y)) // Set the y position of the bar
       .attr("width", x.bandwidth()) // Set the width of the bar
       .attr("height", d => height - y(d.y)) // Set the height of the bar
       .attr("fill", "white"); // Set the color of the bar
}

// Fetch data and draw the chart
function fetch_week(){
    fetch('./report/test.php')
    .then(response => response.json())
    .then(data => {
        draw_chart_week(data); // Draw the chart with the fetched data
    })
    .catch(error => console.error('Error fetching data:', error)) // Handle any errors
}

fetch_week();
// Set the interval to fetch data every 2 seconds
setInterval(ran, 60);
