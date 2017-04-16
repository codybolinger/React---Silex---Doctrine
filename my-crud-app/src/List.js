import React, { Component } from 'react';
import axios from 'axios';
import ItemForm from './ItemForm';
import ListItem from './ListItem';

class List extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listItems: []
    };

    this.removeItem = this.removeItem.bind(this);
  }
  componentDidMount() {
    var self = this;

    axios
        .get("http://localhost:8000/api/items")
        .then(function(result) {    
          self.setState({
            listItems: result.data.items
          });
        });
  }
  addItem(value){
    var item = {name: value};

    axios
        .post("http://localhost:8000/api/items", {
          name: value,
          sort: 5
        });
      //TODO update item with proper ID;

      item.itemid = Math.floor(Math.random() * 10);

    this.state.listItems.push(item);
    this.setState({listItems: this.state.listItems});
  }
  editItem(item){
    //todo edit item
  }
  removeItem(itemid){
    var items = this.state.listItems.filter(function(item){
        if(item.itemid !== itemid){
          return item;
        }
    });

    this.setState({listItems: items});

    axios.delete("http://localhost:8000/api/items/" + itemid);
  }
  render() {
    return (
      <div className="panel panel-primary" style={{width: '50%', margin: '0 auto'}}>
        <div className="panel-heading">
          <h2>My CRUD App</h2>
        </div>
        <ul className="panel-body list-group">
          <ItemForm addItem={this.addItem.bind(this)}/>
          {this.state.listItems.map(function(item) {
            return (
              <li
                key={ item.itemid }
                className="list-group-item">
                {item.name}
                <button className="glyphicon glyphicon-trash"  style={{float: 'right', marginLeft: '20px'}}
                onClick={this.removeItem.bind(this, item.itemid)}></button>
              </li>
            );
          }.bind(this)
          )};
          </ul>
        
      </div>
    );    
  }
}

export default List;
