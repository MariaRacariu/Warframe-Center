//Modules
const cors = require('cors');
const lodash = require('lodash');
const bodyParser = require('body-parser');
const express = require("express");
const app = express();
const port = process.env.PORT || 9000

const worldStateData = require('warframe-worldstate-data');
const Items = require('warframe-items');



app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(cors());

app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});

app.post("/api/post/worldstate", (request, response) => {
    let solNodeNumber = request.body.solNodeNumber;
    if (!solNodeNumber) {
        return res.status(400).json({ error: "solNodeNumber is required" });
    }

    let nodes = worldStateData.solNodes;
    let completeNode = `SolNode${solNodeNumber}`
    const erpo = nodes[completeNode];

    if (!erpo) {
        return res.status(404).json({ error: "Node not found" });
    }

    response.json(erpo);
});

app.get('/api/post/all/formatted/:type', (req, res, next) => {
    const items = new Items({ category: [req.params.type] })
    switch (req.params.type) {
        case "Skins":
            res.json(objectFormatter(items, ["category", "excludeFromCodex", "tradeable", "uniqueName"]));
            break;
        case "Warframes":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]));
            break;
        case "Primary":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]));
            break;
        case "Secondary":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]));
            break;
        case "Melee":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]));
            break;
        case "All":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]));
            break;
        default:
            return res.status(400).json({ error: "Invalid type parameter" });
    }
    res.json(formattedItems);
});

function objectFormatter(items, paths) {
    let formatted = [];

    for (let i = 0; i < items.length; i++) {
        formatted.push(lodash.omit(items[i], paths));
    }
    return formatted;
}
