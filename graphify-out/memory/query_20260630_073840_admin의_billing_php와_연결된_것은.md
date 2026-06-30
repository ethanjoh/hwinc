---
type: "query"
date: "2026-06-30T07:38:40.562307+00:00"
question: "admin의 billing.php와 연결된 것은?"
contributor: "graphify"
outcome: "useful"
source_nodes: ["billing.php", "save-billing.php", "billing-list.php"]
---

# Q: admin의 billing.php와 연결된 것은?

## Answer

Expanded from original query via vocab: [admin, billing, php]. Traversed nodes: billing.php, save-billing.php, billing-list.php. Connections: admin/billing.php renders the billing form which uses admin/js/custom.js to AJAX POST to admin/save-billing.php. admin/billing-list.php displays the billings from the database and links to admin/del-pay.php for cancellation, and admin/export-csv.php for CSV exports.

## Outcome

- Signal: useful

## Source Nodes

- billing.php
- save-billing.php
- billing-list.php