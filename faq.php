<?php include 'includes/header.php'; ?>

<style>
/* Simple styling for FAQ accordion */
details {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 10px;
    padding: 15px;
}
summary {
    font-weight: bold;
    cursor: pointer;
    font-size: 1.1em;
    color: var(--secondary-color);
}
details[open] summary {
    color: var(--primary-color);
}
details > p {
    padding-top: 10px;
    margin-top: 10px;
    border-top: 1px solid #eee;
}
</style>

<div class="main-content">
    <h2>Frequently Asked Questions (FAQ)</h2>
    <p>Find answers to common questions about blood donation below.</p>
    <hr style="margin:20px 0;">

    <details>
        <summary>Who can donate blood?</summary>
        <p>Most healthy adults between the ages of 18 and 65 can donate blood. You must weigh at least 50 kg and be in good health. Specific eligibility criteria may vary, so it's best to check with the donation center.</p>
    </details>

    <details>
        <summary>How often can I donate blood?</summary>
        <p>A healthy individual can donate whole blood every 3 to 4 months (90-120 days). Platelet donations can be made more frequently.</p>
    </details>

    <details>
        <summary>What should I do before donating?</summary>
        <p>Before donating, you should get a good night's sleep, eat a healthy meal, and drink plenty of fluids. Avoid fatty foods and alcohol before your donation.</p>
    </details>

    <details>
        <summary>Is donating blood safe?</summary>
        <p>Yes, it is very safe. All needles and blood bags used are new, sterile, and disposable. They are used only once for your donation and then safely discarded.</p>
    </details>
    
    <details>
        <summary>How long does the donation process take?</summary>
        <p>The entire process, including registration, a mini-medical check-up, the donation itself, and a short rest with refreshments, typically takes about 45 minutes to an hour. The actual blood donation part only takes about 10-15 minutes.</p>
    </details>

</div>

<?php include 'includes/footer.php'; ?>