import "./App.css";
import * as React from "react";
import {
  Box,
  Button,
  IconButton,
  Skeleton,
  ToggleButton,
  ToggleButtonGroup,
} from "@mui/material";
import axios from "axios";
import OrdersTable from "./components/OrdersTable";
import StoreTable from "./components/StoreTable";
import PurchaseHistoryTable from "./components/PurchaseHistoryTable";
import RecipesTable from "./components/RecipesTable";
import UpdateIcon from "@mui/icons-material/Update";

function App() {
  const [orders, setOrders] = React.useState([]);
  const [stocks, setStocks] = React.useState([]);
  const [recipes, setRecipes] = React.useState([]);
  const [loading, setLoading] = React.useState(false);
  const [option, setoption] = React.useState("orders");
  const [purchaseHistories, setPurchaseHistories] = React.useState([]);

  React.useEffect(() => {
    getOrders();
  }, []);

  React.useEffect(() => {
    getAccordingOption();
  }, [option]);

  const getAccordingOption = () => {
    switch (option) {
      case "orders":
        getOrders();
        break;
      case "store":
        getStocks();
        break;
      case "purchaseHistory":
        getPurchaseHistory();
        break;
      case "recipes":
        getRecipes();
        break;
    }
  };

  const getOrders = () => {
    setLoading(true);
    axios
      .get("http://" + process.env.REACT_APP_API_URL + "/orders/orders")
      .then((response) => {
        setOrders(response.data);
      })
      .catch((e) => console.log(e))
      .finally(() => setLoading(false));
  };

  const getStocks = () => {
    setLoading(true);
    axios
      .get("http://" + process.env.REACT_APP_API_URL + "/store/stocks/")
      .then((response) => {
        setStocks(response.data);
      })
      .catch((e) => console.log(e))
      .finally(() => setLoading(false));
  };

  const getPurchaseHistory = () => {
    setLoading(true);
    axios
      .get(
        "http://" + process.env.REACT_APP_API_URL + "/store/purchase-histories/"
      )
      .then((response) => {
        setPurchaseHistories(response.data);
      })
      .catch((e) => console.log(e))
      .finally(() => setLoading(false));
  };

  const getRecipes = () => {
    setLoading(true);
    axios
      .get("http://" + process.env.REACT_APP_API_URL + "/recipes/recipes/")
      .then((response) => {
        setRecipes(response.data);
      })
      .catch((e) => console.log(e))
      .finally(() => setLoading(false));
  };

  const orderFood = () => {
    setLoading(true);
    axios
      .post("http://" + process.env.REACT_APP_API_URL + "/orders/orders/")
      .then(() => {
        getAccordingOption();
      })
      .catch((e) => console.log(e))
      .finally(() => setLoading(false));
  };

  const handleChange = (event, newOption) => {
    setoption(newOption);
  };

  return (
    <div className="App">
      <header className="App-header">
        <Button sx={{ background: "white" }} onClick={() => orderFood()}>
          Order Food
        </Button>
        <IconButton
          onClick={getAccordingOption}
          sx={{ background: "white", marginTop: "30px" }}
        >
          <UpdateIcon />
        </IconButton>
        <ToggleButtonGroup
          sx={{ background: "white", width: "90%" }}
          color="primary"
          value={option}
          exclusive
          onChange={handleChange}
        >
          <ToggleButton fullWidth value="orders">
            Orders
          </ToggleButton>
          <ToggleButton fullWidth value="store">
            Store
          </ToggleButton>
          <ToggleButton fullWidth value="purchaseHistory">
            Purchase History
          </ToggleButton>
          <ToggleButton fullWidth value="recipes">
            Recipes
          </ToggleButton>
        </ToggleButtonGroup>
        <Box width={"90%"} maxHeight={"400px"} background={"white"}>
          {loading ? (
            <Box
              sx={{
                background: "white",
                height: "400px",
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                color: "#1E1E1E",
              }}
            >
              Loading...
            </Box>
          ) : option == "orders" ? (
            <OrdersTable orders={orders} />
          ) : option == "store" ? (
            <StoreTable stocks={stocks} />
          ) : option == "purchaseHistory" ? (
            <PurchaseHistoryTable purchaseHistories={purchaseHistories} />
          ) : (
            <RecipesTable recipes={recipes} />
          )}
        </Box>
      </header>
    </div>
  );
}

export default App;
