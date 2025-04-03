 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

  
    @vite('resources/css/admin.css')
 </head>
 <body>
    
    <header class="management-header">
        <h2 class="management-title">Vehicle Management System</h2>
        <div class="header-actions">
            <button id="toggleFormBtn" onclick="toggleForm()">Register New Vehicle</button>
        </div>
    </header>

@livewire('vehicle-registration')




<style>
    /* Base Styles */
    .vehicle-management-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        color: #333;
    }
    
    /* Header Styles */
    .management-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .management-title {
        font-size: 24px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }
    
    .toggle-form-btn {
        background-color: #3490dc;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.3s;
    }
    
    .toggle-form-btn:hover {
        background-color: #2779bd;
    }
    
    /* Form Card Styles */
    .registration-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        overflow: hidden;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        color: #2c3e50;
    }
    
    .close-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #6c757d;
    }
    
    /* Form Styles */
    .registration-form {
        padding: 20px;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group.span-2 {
        grid-column: span 2;
    }
    
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #495057;
    }
    
    .form-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s;
    }
    
    .form-input:focus {
        border-color: #3490dc;
        outline: none;
        box-shadow: 0 0 0 3px rgba(52, 144, 220, 0.2);
    }
    
    select.form-input {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 16px;
    }
    
    textarea.form-input {
        min-height: 100px;
        resize: vertical;
    }
    
    .checkbox-label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    
    .checkbox-input {
        margin-right: 8px;
    }
    
    .form-error {
        color: #e3342f;
        font-size: 13px;
        margin-top: 5px;
        display: block;
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 15px;
        border-top: 1px solid #e0e0e0;
    }
    
    .cancel-btn {
        background-color: #f8f9fa;
        color: #6c757d;
        border: 1px solid #ddd;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .submit-btn {
        background-color: #38c172;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .submit-btn:hover {
        background-color: #2fa360;
    }
    
    /* Alert Styles */
    .alert {
        padding: 12px 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-icon {
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }
    
    /* Vehicle List Styles */
    .vehicle-list-section {
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    
    .section-title {
        font-size: 18px;
        font-weight: 600;
        margin-top: 0;
        margin-bottom: 20px;
        color: #2c3e50;
    }
    
    .list-actions {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .search-box {
        position: relative;
        width: 300px;
    }
    
    .search-box input {
        width: 100%;
        padding: 8px 15px 8px 35px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
    
    .search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        fill: #6c757d;
    }
    
    .filter-options select {
        padding: 8px 15px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
    
    /* Table Styles */
    .vehicle-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .vehicle-table th, 
    .vehicle-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .vehicle-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
    }
    
    .vehicle-table tr:hover {
        background-color: #f8f9fa;
    }
    
    .status-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-badge.active {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-badge.inactive {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .edit-btn {
        background-color: #3490dc;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 13px;
    }
    
    .delete-btn {
        background-color: #e3342f;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 13px;
    }
    
    .no-records {
        text-align: center;
        padding: 20px;
        color: #6c757d;
    }
    
    /* Pagination Styles */
    .pagination-container {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .form-group.span-2 {
            grid-column: span 1;
        }
        
        .list-actions {
            flex-direction: column;
            gap: 10px;
        }
        
        .search-box {
            width: 100%;
        }
        
        .vehicle-table th, 
        .vehicle-table td {
            padding: 8px 10px;
        }
    }
</style>

<script>
    function toggleForm() {
        const form = document.getElementById("registrationForm");
        const button = document.getElementById("toggleFormBtn");
        
        // Toggle visibility
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
            button.textContent = "Hide Registration Form";
        } else {
            form.style.display = "none";
            button.textContent = "Register New Vehicle";
        }
    }
</script>
 </body>
 </html>