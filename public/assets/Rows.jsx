import Card from './Card.jsx'

class Rows extends React.Component {


    render() {

        var elem = document.getElementById("cards");
        var titre = elem.dataset.title.split(',');
        var desc = elem.dataset.description.split(',');

        return (<div><div className="row p-1">
            <div className="col p-1">
                <Card title={titre[0]} description={desc[0]} />
            </div>
            <div className="col p-1">
                <Card title={titre[1]} description={desc[1]} />
            </div>
        </div>
        <div className="row p-0">
            <div className="col p-1">
                <Card title={titre[2]} description={desc[2]} />
            </div>
            <div className="col p-1">
                <Card title={titre[3]} description={desc[3]} />
            </div>
        </div></div>);

    }
}
const elem = document.getElementById("cards");

ReactDOM.render(React.createElement(Rows), elem)
