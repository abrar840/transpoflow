// Simulated cargo data
const cargoData = [
    {
        shipperCity: "Lahore",
        consigneeCity: "Karachi",
        shipperName: "Ali",
        shipperPhone: "123456789",
        shipperAddress: "123 Main St, Lahore",
        consigneeName: "Ahmed",
        consigneePhone: "987654321",
        consigneeAddress: "456 Main St, Karachi",
        consigneeEmail: "ahmed@example.com",
        deliveryOption: "Home",
        orderId: "ORD123",
        orderDate: "2025-03-01",
        itemDescription: "Electronics",
        itemQuantity: 2,
        insurance: "Yes",
        weight: 10,
        length: 50,
        width: 30,
        height: 20,
        totalCharges: "500 Rs"
    },
    {
        shipperCity: "Karachi",
        consigneeCity: "Lahore",
        shipperName: "Bilal",
        shipperPhone: "111222333",
        shipperAddress: "789 Main St, Karachi",
        consigneeName: "Farhan",
        consigneePhone: "444555666",
        consigneeAddress: "321 Main St, Lahore",
        consigneeEmail: "farhan@example.com",
        deliveryOption: "Company Office",
        orderId: "ORD124",
        orderDate: "2025-03-02",
        itemDescription: "Clothing",
        itemQuantity: 5,
        insurance: "No",
        weight: 5,
        length: 40,
        width: 20,
        height: 10,
        totalCharges: "300 Rs"
    }
];

// Function to filter cargo data based on user input
function filterCargo() {
    const shipperCity = document.getElementById('shipperCity').value;
    const consigneeCity = document.getElementById('consigneeCity').value;
    const orderDate = document.getElementById('orderDate').value;

    return cargoData.filter(cargo => {
        return (!shipperCity || cargo.shipperCity === shipperCity) &&
               (!consigneeCity || cargo.consigneeCity === consigneeCity) &&
               (!orderDate || cargo.orderDate === orderDate);
    });
}

// Function to display filtered cargo data
function displayCargo() {
    const filteredCargo = filterCargo();
    const cargoContainer = document.createElement("div");
    cargoContainer.innerHTML = ""; // Clear existing content

    if (filteredCargo.length === 0) {
        cargoContainer.innerHTML = "<p>No cargo found for the selected criteria.</p>";
        return;
    }

    filteredCargo.forEach(cargo => {
        const cargoCard = document.createElement("div");
        cargoCard.innerHTML = `
            <h3>Order ID: ${cargo.orderId}</h3>
            <p><strong>Shipper:</strong> ${cargo.shipperName} (${cargo.shipperCity})</p>
            <p><strong>Consignee:</strong> ${cargo.consigneeName} (${cargo.consigneeCity})</p>
            <p><strong>Date:</strong> ${cargo.orderDate}</p>
            <p><strong>Total Charges:</strong> ${cargo.totalCharges}</p>
        `;
        cargoContainer.appendChild(cargoCard);
    });

    document.body.appendChild(cargoContainer);
}

// Function to generate PDF with company logo
function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Add company logo
    const logoURL = "logo.png"; // Replace with your logo path
    doc.addImage(logoURL, "PNG", 80, 10, 50, 20);

    // Company details
    doc.setFontSize(20);
    doc.text("Your Perfect Cargo Partner", 70, 20);
    doc.setFontSize(10);
    doc.text("Lahore, Pakistan", 70, 30);
    doc.text("Contact: +92332450258 | Email: contact@cargo.com", 70, 40);
    doc.text("Website: www.cargo.com", 70, 50);

    doc.setLineWidth(0.5);
    doc.line(20, 75, 190, 75);
    doc.setFontSize(14);
    doc.text("Cargo Shipment Details", 80, 85);

    // Collect form data
    const shipperCity = document.getElementById('shipperCity').value;
    const shipperName = document.getElementById('shipperName').value;
    const shipperPhone = document.getElementById('shipperPhone').value;
    const shipperAddress = document.getElementById('shipperAddress').value;

    const consigneeCity = document.getElementById('consigneeCity').value;
    const consigneeName = document.getElementById('consigneeName').value;
    const consigneePhone = document.getElementById('consigneePhone').value;
    const consigneeAddress = document.getElementById('consigneeAddress').value;

    const consigneeEmail = document.getElementById('consigneeEmail').value;
    const deliveryOption = document.getElementById('deliveryOption').value;

    const orderId = document.getElementById('orderId').value;
    const orderDate = document.getElementById('orderDate').value;
    const itemDescription = document.getElementById('itemDescription').value;
    const itemQuantity = document.getElementById('itemQuantity').value;
    const insurance = document.getElementById('insurance').value;

    const weight = document.getElementById('weight').value;
    const length = document.getElementById('length').value;
    const width = document.getElementById('width').value;
    const height = document.getElementById('height').value;

    const totalCharges = document.getElementById('totalCharges').innerText;

    // Add content to PDF
    doc.setFontSize(12);
    doc.text("Shipper Information", 10, 70);
    doc.text(`City: ${shipperCity}`, 10, 80);
    doc.text(`Name: ${shipperName}`, 10, 90);
    doc.text(`Contact: ${shipperPhone}`, 10, 100);
    doc.text(`Address: ${shipperAddress}`, 10, 110);

    doc.text("Consignee Information", 10, 130);
    doc.text(`City: ${consigneeCity}`, 10, 140);
    doc.text(`Name: ${consigneeName}`, 10, 150);
    doc.text(`Address: ${consigneeAddress}`, 10, 160);
    doc.text(`Phone: ${consigneePhone}`, 10, 170);
    doc.text(`Email: ${consigneeEmail}`, 10, 180);
    doc.text(`Delivery Option: ${deliveryOption}`, 10, 190);

    doc.text("Order Information", 10, 210);
    doc.text(`Order ID: ${orderId}`, 10, 220);
    doc.text(`Order Date: ${orderDate}`, 10, 230);
    doc.text(`Item Description: ${itemDescription}`, 10, 240);
    doc.text(`Item Quantity: ${itemQuantity}`, 10, 250);
    doc.text(`Insurance: ${insurance}`, 10, 260);

    doc.text("Rate Calculation", 10, 280);
    doc.text(`Weight: ${weight} kg`, 10, 290);
    doc.text(`Dimensions (LxWxH): ${length}cm x ${width}cm x ${height}cm`, 10, 300);
    doc.text(`Total Charges: ${totalCharges}`, 10, 310);

    // Save the PDF
    doc.save("cargo_ticket.pdf");
}

// Event listener for displaying cargo data
document.addEventListener('DOMContentLoaded', () => {
    const searchButton = document.querySelector('.calculate-btn');
    if (searchButton) {
        searchButton.addEventListener('click', displayCargo);
    }
});