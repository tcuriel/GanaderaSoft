import { Grid } from "../node_modules/ag-grid-community/dist/ag-grid-community";

import "../node_modules/ag-grid-community/dist/styles/ag-grid.css";
import "../node_modules/ag-grid-community/dist/styles/ag-theme-alpine.css";

import gridData from "./grid-data.json";

// let the grid know which columns and what data to use
const gridOptions = {
  defaultColDef: {
    resizable: true,
    sortable: true,
    filter: "agTextColumnFilter"
  },
  columnDefs: gridData.columnDefs,
  rowData: gridData.rowData
};

const gridDiv = document.querySelector("#student-data");
new Grid(gridDiv, gridOptions);
