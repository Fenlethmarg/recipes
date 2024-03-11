import {
  Paper,
  Table,
  TableHead,
  TableBody,
  TableContainer,
  TableRow,
  TableCell,
} from "@mui/material";
import * as React from "react";
import moment from "moment";

const OrdersTable = (props) => {
  const columns = ["Order Date", "Recipe", "Status"];

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
          {props.orders.map((order) => (
            <TableRow key={order.id}>
              <TableCell sx={styles.table.cells}>{moment(order?.created_at).format('DD/MM/yyyy HH:mm:ss')}</TableCell>
              <TableCell sx={styles.table.cells}>{order?.recipe}</TableCell>
              <TableCell sx={styles.table.cells}>{order?.status}</TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </TableContainer>
  );
};
export default OrdersTable;
