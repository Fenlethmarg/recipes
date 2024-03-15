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

const RecipesTable = (props) => {
  const columns = ["Recipe", "Ingredients", "Quantity"];

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
        padding: "5px",
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
          {props.recipes.map((recipe) => (
            <React.Fragment>
              <TableRow key={recipe.id}>
                <TableCell sx={styles.table.cells} rowSpan={recipe.ingredients.length + 1}>{recipe?.name}</TableCell>
              </TableRow>
              {
                recipe.ingredients.map((ingredient) => (
                  <TableRow key={ingredient?.id}>
                    <TableCell sx={styles.table.cells}>{ingredient?.name}</TableCell>
                    <TableCell sx={styles.table.cells}>{ingredient?.pivot?.quantity}</TableCell>
                  </TableRow>
                ))
              }
            </React.Fragment>
          ))}
        </TableBody>
      </Table>
    </TableContainer>
  );
};
export default RecipesTable;
