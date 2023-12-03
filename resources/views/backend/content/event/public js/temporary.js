 // var click = document.getElementById('add-items');
// click.addEventListener('click', addData);
jQuery(document).ready(function () {
    // Get the form element
    var add = document.getElementById("add");
    
    // Add an event listener to the form for form submission
    add.addEventListener('click', function(event) {
        
       event.preventDefault(); // Prevent form submission
   
        // Get the user inputs from the form
        var ticketType = document.getElementById("ticket-type-list-item").value;
        var ticketPrice = document.getElementById("ticket-price-list-item").value;
        var totalTicket = document.getElementById("total-ticket-list-item").value;
       
        //Ensure receiving the value
        if (ticketType && ticketPrice && totalTicket) {
           // Create an object to store the user inputs
           var ticket = {
               type: ticketType,
               price: ticketPrice,
               total: totalTicket
           };
   
        }
        
   
        // Retrieve existing ticket data from local storage
        var existingTickets = JSON.parse(localStorage.getItem('ticketTypeInformation')) || [];
   
        // Add the new ticket to the existing data
        existingTickets.push(ticket);
   
        // Save the updated ticket data in local storage
        localStorage.setItem('ticketTypeInformation', JSON.stringify(existingTickets));
   
        // Display the ticket data in the table body
        var tableBody = document.getElementById('main-ticket-type-table-body');
   
        // Clear the existing table rows
        tableBody.innerHTML = '';
   
        // Loop through the ticket data and create table rows
        existingTickets.forEach(function (ticket) {
            var row = document.createElement('tr');
            var ticketTypeCell = document.createElement('td');
            var ticketPriceCell = document.createElement('td');
            var totalTicketCell = document.createElement('td');
   
            ticketTypeCell.textContent = ticket.type;
            ticketPriceCell.textContent = ticket.price;
            totalTicketCell.textContent = ticket.total;
   
            row.appendChild(ticketTypeCell);
            row.appendChild(ticketPriceCell);
            row.appendChild(totalTicketCell);
   
            tableBody.appendChild(row);
        });
   
       //  // Store the ticket object in local storage
       //  localStorage.setItem("ticket", JSON.stringify(ticketTypeInformation));
   
       //  // Call the function to display the ticket in the table
       //  displayTicketType();
       });
   });
    
   
    // Function to display the ticket in the table
   //  function displayTicketType() {
   //      var storedTicketType = localStorage.getItem("ticketTypeInformation");
   //      if (storedTicketType) {
   //          var ticket = JSON.parse(storedTicketType);
   
   //          var table = document.getElementById("ticketTable");
   
   //          var row = table.insertRow(1);
   //          var typeCell = row.insertCell(0);
   //          var priceCell = row.insertCell(1);
   //          var totalCell = row.insertCell(2);
   
   //          typeCell.innerHTML = ticket.type;
   //          priceCell.innerHTML = ticket.price;
   //          totalCell.innerHTML = ticket.total;
   //      }
   //  }