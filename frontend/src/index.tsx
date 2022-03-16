import * as React from 'react';
import * as ReactDOM from 'react-dom';
import './styles/custom.scss';
import {Route, BrowserRouter, Routes} from "react-router-dom";
import Auction from "./components/Auction";

ReactDOM.render(
    <div>
        <h1>Bidder</h1>
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Auction />}/>
            </Routes>
        </BrowserRouter>
    </div>,
    document.getElementById('root')
);