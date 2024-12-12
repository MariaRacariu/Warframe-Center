const worldstateData = require('warframe-worldstate-data');
const cors = require('cors');
const lodash = require('lodash');
const bodyParser = require('body-parser');
const Items = require('warframe-items')
const express = require("express");
const app = express();
const port = process.env.PORT || 9000

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended: true}))
app.use(cors())

app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});

app.post("/api/post/worldstate", (req, res, next) => {
    let solNodeNumber = req.body.solNodeNumber;
    let nodes = worldstateData.solNodes;
    let completenode = `SolNode${solNodeNumber}`
    const erpo = nodes[completenode];
    const {enemy, value, type} = erpo;
    res.json(erpo);
});

app.get('/api/post/all/formatted/:type', (req, res, next) => {
    const items = new Items({category: [req.params.type]})
    switch(req.params.type) {
        case "Skins":
            res.json(objectFormatter(items, ["category", "excludeFromCodex", "tradeable", "uniqueName"]))
            break;
        case "Warframes":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]))
            break;
        case "Primary":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]))
            break;
        case "Secondary":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]))
            break;
        case "Melee":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]))
            break;
        case "All":
            res.json(objectFormatter(items, ["patchlogs", "introduced", "uniqueName", "wikiaThumbnail", "wikiaUrl"]))
            break;
        default:
            res.json("Something Broken")
        break;
    }
})

function objectFormatter(items, paths) {
    let formatted = []
    for (let i = 0; i < items.length; i++) {
        // items[i].imageName = `https://cdn.warframestat.us/img/${items[i].imageName}`
        formatted.push(lodash.omit(items[i], paths))
    }
    return formatted
}
