import React, { Component } from 'react';


class ItemForm extends Component {
  constructor(props) {
    super(props);
    this.state = {value: ''};

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }
  handleChange(event) {
    this.setState({value: event.target.value});
  }
  handleSubmit(event) {
    event.preventDefault();
    this.props.addItem(this.state.value);
  }
  render() {
    return (
      <form className="form-inline" onSubmit={this.handleSubmit}>
        <input className="form-control col-md-12" onChange={this.handleChange}/>
        <input className="btn btn-primary" type="submit" value="Add Item" />
        <br />
        <br />
        
      </form>
    );    
  }
}

export default ItemForm;
