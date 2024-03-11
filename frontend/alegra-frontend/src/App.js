import "./App.css";
import * as React from "react";
import {
  Box,
  Button,
  ToggleButton,
  ToggleButtonGroup
} from "@mui/material";
import axios from "axios";
import OrdersTable from "./components/OrdersTable";
import StoreTable from "./components/StoreTable";
import PurchaseHistoryTable from "./components/PurchaseHistoryTable";
import RecipesTable from "./components/RecipesTable";

function App() {
  const [orders, setOrders] = React.useState([]);
  const [stocks, setStocks] = React.useState([]);
  const [recipes, setRecipes] = React.useState([]);
  const [option, setoption] = React.useState('orders');
  const [purchaseHistories, setPurchaseHistories] = React.useState([]);

  React.useEffect(() => {
    getOrders();
  }, []);

  React.useEffect(() => {
    getAccordingOption();
  }, [option]);

  const getAccordingOption = () => {
    switch (option) {
      case 'orders': 
        getOrders();
        break;
      case 'store':
        getStocks();
        break;
      case 'purchaseHistory':
        getPurchaseHistory();
        break;
      case 'recipes':
        getRecipes();
        break;
    }
  }

  const getOrders = () => {
    axios
      .get("http://127.0.0.1:8001/orders/")
      .then((response) => {
        setOrders(response.data);
      })
      .catch((e) => console.log(e));
  };

  const getStocks = () => {
    axios
      .get("http://127.0.0.1:8003/stocks/")
      .then((response) => {
        setStocks(response.data);
      })
      .catch((e) => console.log(e));
  };

  const getPurchaseHistory = () => {
    axios
      .get("http://127.0.0.1:8003/purchase-histories/")
      .then((response) => {
        setPurchaseHistories(response.data);
      })
      .catch((e) => console.log(e));
  };

  const getRecipes = () => {
    axios
      .get("http://127.0.0.1:8002/recipes/")
      .then((response) => {
        setRecipes(response.data);
      })
      .catch((e) => console.log(e));
  };

  const orderFood = () => {
    axios
      .post("http://127.0.0.1:8001/orders/")
      .then(() => {
        getAccordingOption();
      })
      .catch((e) => console.log(e));
  };

  const handleChange = (event, newOption) => {
    setoption(newOption);
  };

  return (
    <div className="App">
      <header className="App-header">
        <Button sx={{background: "white"}} onClick={() => orderFood()}>Order Food</Button>
        <ToggleButtonGroup
          sx={{background: "white", width: "90%", marginTop: "30px"}}
          color="primary"
          value={option}
          exclusive
          onChange={handleChange}
        >
          <ToggleButton fullWidth value="orders">Orders</ToggleButton>
          <ToggleButton fullWidth value="store">Store</ToggleButton>
          <ToggleButton fullWidth value="purchaseHistory">Purchase History</ToggleButton>
          <ToggleButton fullWidth value="recipes">Recipes</ToggleButton>
        </ToggleButtonGroup>
        <Box width={'90%'} maxHeight={"400px"} background={"white"}>
          {
            option == 'orders' ?
              <OrdersTable orders = {orders}/>
              : option == 'store' ?
                <StoreTable stocks = {stocks}/>
                : option == 'purchaseHistory' ?
                  <PurchaseHistoryTable purchaseHistories = {purchaseHistories}/>
                    : <RecipesTable recipes = {recipes} />
          }
        </Box>
      </header>
    </div>
  );
}

export default App;
