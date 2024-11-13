// loop for table id
let table_id = [];
let table_count = 50;
for (i = 0; i <= table_count; i++) {
  table_id.push(`#table${i}`);
}

// loop for datatable
table_id.forEach((id) => {
  let jquery_datatable = $(id).DataTable({
    responsive: true,
  });
  jquery_datatable.on("draw", function () {
    setTableColor(id);
  });
});

// loop
table_id.forEach((id) => {
  setTableColor(id);
});
