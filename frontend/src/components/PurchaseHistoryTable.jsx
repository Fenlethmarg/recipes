import {
  Paper,
  Table,
  TableHead,
  TableBody,
  TableContainer,
  TableRow,
  TableCell,
} from "@mui/material";
import moment from "moment";
import * as React from 'react';
const PurchaseHistoryTable = (props) => {
  
  const columns = ["Purchase Date", "Ingredient", "Quantity"];

  const styles = {
    table: {
      title: {
        color: "#1E1E1E",
        fontSize: "16px",
        fontWeight: "600",
        letterSpacing: "0.048px",
        margin: "12px 0",
      },
      headers: {
        fontSize: "12px",
        fontWeight: "600",
        lineHeight: "20px",
        color: "#737589",
        textAlign: "center",
        padding: "15px 5px",
      },
      cells: {
        fontSize: "12px",
        fontWeight: "400",
        lineHeight: "20px",
        color: "#667085",
        textAlign: "center",
      },
    },
  };
  return (
    <TableContainer
      component={Paper}
      sx={{ overflowY: "auto", height: "400px" }}
    >
      <Table>
        <TableHead sx={{ position: "sticky", top: "0px", margin: "0 0" }}>
          <TableRow sx={{ background: "#F9FAFB" }}>
            {columns.map((col) => (
              <TableCell key={col} sx={styles.table.headers}>
                {col}
              </TableCell>
            ))}
          </TableRow>
        </TableHead>
        <TableBody>
          {props.purchaseHistories.map((purchaseHistory) => (
            <TableRow key={purchaseHistory.id}>
              <TableCell sx={styles.table.cells}>{moment(purchaseHistory?.created_at).format('DD/MM/yyyy HH:mm:ss')}</TableCell>
              <TableCell sx={styles.table.cells}>{purchaseHistory?.ingredient?.name}</TableCell>
              <TableCell sx={styles.table.cells}>{purchaseHistory?.quantity}</TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </TableContainer>
  );
};
export default PurchaseHistoryTable;
