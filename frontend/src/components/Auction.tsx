import * as React from "react";
import {useEffect, useState} from "react";
import {httpPost} from "../utils/http-client";

const Auction: React.FC<{}> = function (props) {
    const [bid, setBid] = useState(0);
    const [winnerBid, setWinnerBid] = useState(0);

    useEffect(() => {
        const url = `http://127.0.0.1:9090/.well-known/mercure?topic=auctions-1`;
        const eventSource = new EventSource(url);

        eventSource.onmessage = event => {
            const results = JSON.parse(event.data);
            setWinnerBid(results.winnerBid);
        }

        return() => {
            eventSource.close();
        }
    }, []);

    const make_bid = async () => {
        const data = {
            bid
        }
        const response = await httpPost('http://localhost:8070/auctions/1/bid', data)
        setBid(response.data);
    };

    return (
        <div className="bidder-container">
            <div className="container">
                <div className="d-flex">
                    <input className="form-control mr-1" type="number" onChange={e => setBid(e.currentTarget.valueAsNumber)}/>
                    <button className="btn btn-success" onClick={() => make_bid()}>BID</button>
                </div>
                <div className="row mt-4">
                    <p>Actual winner bid: {winnerBid}</p>
                </div>
            </div>
        </div>
    );
}

export default Auction
