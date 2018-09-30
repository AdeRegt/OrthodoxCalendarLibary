import React, { Component } from 'react';
import '../App.css';
import uuid from 'uuid';

class Calendar extends Component {
  constructor(props){
    super(props);

    this.weekDays = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
    this.months = ['Januari', 'Februari', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'];

    this.currentDate = new Date();
    this.changeYear = this.changeYear.bind(this);

    this.state = {
      year:this.currentDate.getFullYear(),
      month:this.currentDate.getMonth()
    };
  }

  showNextMonth = () => {
    const month = this.state.month < 11 ? this.state.month + 1  : 0;
    const year = this.state.month < 11 ? this.state.year : this.state.year + 1;

    this.setState({month,year})
  }

  showPreviousMonth = () => {
    const month = this.state.month > 0 ? this.state.month - 1  : 11;
    const year = this.state.month > 0 ? this.state.year : this.state.year - 1;

    this.setState({month,year})
  }

 showDays = (year, month) => {
   const currentDt = new Date(year, month, 0);

    const days = [];
    for(let i = 1; i <= 35; i++){
      if(i <= currentDt.getDay()){
        days.push(<div className="grid-item" key={uuid()}></div>);
      } else {
        let date = i - currentDt.getDay();

        let dayClass = "grid-item day";

        const cd = this.currentDate.toString();
        const ncd = new Date(year, month, date).toString();

        if(cd.slice(0,10) === ncd.slice(0,10)){
          dayClass += " current-date";
        }
        days.push(<div className={dayClass} key={uuid()}>{date}</div>);
      }
    }
    return <div className="grid-container">{days}</div>;
  }

  showWeeks(){
    return <div className="grid-container week-container">{this.weekDays.map(weekDay => <div className="grid-item" key={uuid()}>{weekDay}</div>)}</div>;
  }

  yearsSelect(){
    const years = [];
    const currentYear = this.currentDate.getFullYear();
    for(let i = currentYear - 10; i <= currentYear; i++){
      years.push(<option value={i} key={uuid()}>{i}</option>);
    }
    return <select name="year" id="year-selection" className="year-selection" onChange={this.changeYear} value={this.state.year}>{years}</select>
  }

  changeYear(event){
    console.log(event.target.value);
    const year = parseInt(event.target.value, 10);
    this.setState({year});
  }

  render() {
    return (
      <div>
        <div className="flex-container">
          <div className="flex-buttons">
            <button className="btn" onClick={this.showPreviousMonth}>Previous</button>
            <button className="btn" onClick={this.showNextMonth}>Next</button>
          </div>
          <div className="flex-selected-date">
            {this.months[this.state.month]} - {this.state.year}
          </div>
          <div className="flex-year-selection">
            {this.yearsSelect()}
          </div>
        </div>
        {this.showWeeks()}
        {this.showDays(this.state.year, this.state.month)}
      </div>
    );
  }
}

export default Calendar;
