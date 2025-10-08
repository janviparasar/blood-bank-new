<?php include 'includes/header.php'; ?>

<div class="main-content">
    <h2>Blood Group Compatibility Chart</h2>
    <p>This chart shows which blood types can be safely transfused between a donor and a recipient.</p>
    
    <style>
        .compatibility-table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 1.1em; text-align: center; }
        .compatibility-table th, .compatibility-table td { border: 1px solid #ddd; padding: 12px; }
        .compatibility-table th { background-color: #f2f2f2; }
        .compatibility-table .can-donate { background-color: #dff0d8; color: #3c763d; } /* Green for Yes */
        .compatibility-table .cannot-donate { background-color: #f2dede; color: #a94442; } /* Red for No */
    </style>

    <table class="compatibility-table">
        <thead>
            <tr>
                <th>Recipient Blood Type</th>
                <th>Can Receive From</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>A+</strong></td>
                <td class="can-donate">A+, A-, O+, O-</td>
            </tr>
            <tr>
                <td><strong>O+</strong></td>
                <td class="can-donate">O+, O-</td>
            </tr>
            <tr>
                <td><strong>B+</strong></td>
                <td class="can-donate">B+, B-, O+, O-</td>
            </tr>
             <tr>
                <td><strong>AB+</strong></td>
                <td class="can-donate">Everyone</td>
            </tr>
            <tr>
                <td><strong>A-</strong></td>
                <td class="can-donate">A-, O-</td>
            </tr>
             <tr>
                <td><strong>O-</strong></td>
                <td class="can-donate">O-</td>
            </tr>
             <tr>
                <td><strong>B-</strong></td>
                <td class="can-donate">B-, O-</td>
            </tr>
             <tr>
                <td><strong>AB-</strong></td>
                <td class="can-donate">AB-, A-, B-, O-</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>