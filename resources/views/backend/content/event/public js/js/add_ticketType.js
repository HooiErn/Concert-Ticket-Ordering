jQuery(document).ready(function () {
  // Get the form element
  var add = document.getElementById("add");

  // Create an array to store the ticket data
  var ticketData = [];

  // Add an event listener to the form for form submission
  add.addEventListener('click', function (event) {
    event.preventDefault(); // Prevent form submission

    // Get the user inputs from the form
    var ticketType = document.getElementById("ticket-type-list-item").value;
    var ticketPrice = document.getElementById("ticket-price-list-item").value;
    var totalTicket = document.getElementById("total-ticket-list-item").value;

    // Ensure receiving the value
    if (ticketType && ticketPrice && totalTicket) {
      // Create an object to store the user inputs
      var ticket = {
        id: Date.now(), // Unique identifier for each ticket
        type: ticketType,
        price: ticketPrice,
        total: totalTicket
      };

      // Add the new ticket to the ticket data
      ticketData.push(ticket);

      // Display the ticket data in the table body
      var tableBody = document.getElementById('main-ticket-type-table-body');

      // Clear the existing table rows
      tableBody.innerHTML = '';

      // Loop through the ticket data and create table rows
      ticketData.forEach(function (ticket) {
        var row = document.createElement('tr');
        row.setAttribute('data-id', ticket.id); // Add data attribute to the row
        var ticketTypeCell = document.createElement('td');
        var ticketPriceCell = document.createElement('td');
        var totalTicketCell = document.createElement('td');

        ticketTypeCell.textContent = ticket.type;
        ticketPriceCell.textContent = ticket.price;
        totalTicketCell.textContent = ticket.total;

        row.appendChild(ticketTypeCell);
        row.appendChild(ticketPriceCell);
        row.appendChild(totalTicketCell);
        
        var removeButton = document.createElement('button');
        removeButton.className = 'remove-ticket-type';
          // Create the icon element
        var icon = document.createElement('i');
        icon.className = 'fa fa-trash'; // assuming you are using Font Awesome icons

          // Append the icon element inside the button element
        removeButton.appendChild(icon);
        row.appendChild(removeButton);

        tableBody.appendChild(row);
      });

      // Reset the form inputs
      document.getElementById("ticket-type-list-item").value = '';
      document.getElementById("ticket-price-list-item").value = '';
      document.getElementById("total-ticket-list-item").value = '';
    }
  });

  $(document).on('click', '.remove-ticket-type', function () {
    //$(this).closest('tr').remove();
    var row = $(this).closest('tr');
    var ticketId = row.data('id');

    // Remove the ticket from the ticketData array
    ticketData = ticketData.filter(function (ticket) {
      return ticket.id !== ticketId;
    });

    // Remove the row from the table
    row.remove();
  });
});
