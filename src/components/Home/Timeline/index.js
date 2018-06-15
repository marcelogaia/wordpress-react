import React, { Component } from 'react';
import moment from "moment";
import { Grid, Row, Col } from "react-bootstrap";
import "./Timeline.css";
import Tooltip from "rc-tooltip";
import 'rc-tooltip/assets/bootstrap_white.css';

class Timeline extends Component {
	
	constructor(props) {
		super(props);
		this.state = {
			data : {
				workLife : [
					{
						title : "PHP Developer",
						subtitle : "Inomax",
						start : moment("2010-07","YYYY-MM"),
						end : moment("2010-12","YYYY-MM"),
					},
					{
						title : "Full-stack Developer",
						subtitle : "Netpoint",
						start : moment("2011-01","YYYY-MM"),
						end : moment("2011-06","YYYY-MM"),
					},
					{
						title : "Full-stack Developer",
						subtitle : "Fess'Kobbi",
						start : moment("2011-07","YYYY-MM"),
						end : moment("2012-09","YYYY-MM"),
					},
					{
						title : "Full-stack Developer",
						subtitle : "Furia Criacoes",
						start : moment("2013-02","YYYY-MM"),
						end : moment("2013-05","YYYY-MM"),
					},
					{
						title : "System Analyst",
						subtitle : "Plusoft",
						start : moment("2013-05","YYYY-MM"),
						end : moment("2014-02","YYYY-MM"),
					},
					{
						title : "Full-stack Developer (Remote)",
						subtitle : "PrnArchitecture",
						start : moment("2016-09","YYYY-MM"),
						end : moment("2017-03","YYYY-MM"),
					},
					{
						title : "This portfolio",
						subtitle : "React/Wordpress",
						start : moment("2018-06","YYYY-MM"),
						end : moment("2018-07","YYYY-MM"),
					},
				],
				lifeEvents : [
					{
						title : "Practiced Parkour",
						subtitle : "Tracer Sao Paulo",
						start : moment("2011-05", "YYYY-MM"),
						end : moment("2012-09","YYYY-MM")
					},
					{
						title : "Shoulder surgery",
						subtitle : "Parkour injury",
						start : moment("2012-09","YYYY-MM"),
						end : moment("2012-10","YYYY-MM"),
					},
					{
						title : "Recovery",
						subtitle : "Shoulder surgery",
						start : moment("2012-10","YYYY-MM"),
						end : moment("2013-02","YYYY-MM"),
					},
					{
						title : "Moved to Canada",
						subtitle : "Victoria BC",
						start : moment("2014-03","YYYY-MM"),
						end : moment("2014-04","YYYY-MM"),
					},
				],
				education : [
					{
						title : "English as a Second Language",
						subtitle : "KGIC",
						start : moment("2014-05","YYYY-MM"),
						end : moment("2014-11","YYYY-MM")
					},
					{
						title : "Bachelor of Design",
						subtitle : "SENAC University Centre",
						start : moment("2007-01","YYYY-MM"),
						end : moment("2010-12","YYYY-MM"),
					},
					{
						title : "Started a Bachelor in Computer Science",
						subtitle : "University of Victoria",
						start : moment("2015-05","YYYY-MM"),
						end : moment("2016-12","YYYY-MM"),
					},
					{
						title : "Diploma in Computer Science",
						subtitle : "Langara",
						start : moment("2017-02","YYYY-MM"),
						end : moment("2019-05","YYYY-MM")
					}
				]
			},
			totalYears : 0,
			boundaries : null
		};

		this.consts = {
			context : null,
			tickWidth : 10,
			leftMargin : 95,
			lineHeight : 20
		}

		this.handleClick = this.handleClick.bind(this);
	}

	handleClick() {
		console.log(this.state.boundaries);
	};

	drawBackground () {
		let tickWidth = this.consts.tickWidth;
		let yearDiff = this.state.totalYears;

		let context = this.consts.context;
		let yStart = 0;
		let yEnd =  context.canvas.height - 30;

		for(let currYear = 0; currYear <= yearDiff; currYear++) {
			context.beginPath();
			context.lineWidth = 3;
			yStart = 0;
			yEnd =  context.canvas.height - 30;
			context.strokeStyle='rgb(154,158,173)';			
			context.moveTo((currYear+1)*12*tickWidth, yStart);
			context.lineTo((currYear+1)*12*tickWidth, yEnd);
			context.stroke();

			for(let currMon = 1; currMon < 12; currMon++) {
				context.beginPath();

				if(currMon % 3 === 0) {
					yStart = 0;
					context.strokeStyle='rgb(12,22,69)';	
					yEnd = context.canvas.height - 55;			
				} else {
					yStart = 10;
					yEnd = context.canvas.height - 65;
					context.strokeStyle="rgb(102,107,136)";
				}

				context.lineWidth = .8;
				context.moveTo(currMon*tickWidth + currYear*12*tickWidth, yStart);
				context.lineTo(currMon*tickWidth + currYear*12*tickWidth, yEnd);
				context.stroke();
			}
		}

	}

	drawYears() {
		let ctx = this.consts.context;

		for(let i = 0; i <= this.state.totalYears; i++) {
			ctx.font = "12px Arial";
			ctx.textAlign = "center";

			ctx.fillText( 
				this.state.boundaries.first.year()+i,
				(i * 12 * this.consts.tickWidth) + 12/2*this.consts.tickWidth,
				this.consts.context.canvas.height - 20
			);
		}
	}

	drawToday() {
		let context = this.consts.context;
		let tickWidth = this.consts.tickWidth;
		// Draw TODAY
		context.beginPath();
		context.lineWidth = 2;
		let yStart = 0;
		let yEnd =  context.canvas.height - 30;
		context.strokeStyle = "red";
		let thisYear = moment().year() - this.state.boundaries.first.year();
		let thisMonth = moment().month() + 1;
		let thisDay = moment().date();
		console.log(thisDay);
		
		context.moveTo(thisDay/31*tickWidth + thisMonth*tickWidth + thisYear*12*tickWidth, yStart);
		context.lineTo(thisDay/30*tickWidth + thisMonth*tickWidth + thisYear*12*tickWidth, yEnd);
		context.stroke();

	}

	createAllEvents() {
		let workLife = this.state.data.workLife;
		let lifeEvents = this.state.data.lifeEvents;
		let education = this.state.data.education;

		let events = [], key = 0;

		for(let i in workLife) {
			events.push(this.createEvent(workLife[i],"work",key++));
		}

		for(let i in lifeEvents) {
			events.push(this.createEvent(lifeEvents[i],"life",key++));
		}

		for(let i in education) {
			events.push(this.createEvent(education[i],"edu",key++));
		}

		return events;
	}

	createEvent(event, category, key) {

		let itemStyle = {
			left : ( 
				(event.start.month()+1) * this.consts.tickWidth + (event.start.year() - 
				this.state.boundaries.first.year()) * 12 * this.consts.tickWidth
			), 
			width : (
				(event.end.month() - event.start.month()) * this.consts.tickWidth + 
				(event.end.year() - event.start.year()) * 12 * this.consts.tickWidth
			)
		};

		return (
			<Tooltip placement="top" trigger={['hover']} overlayClassName={`Tooltip cat-${category}`}
				overlay={<span>{event.title} - {event.subtitle}</span>} key={key}>
				<li title={event.title} subtitle={event.subtitle}
					style={itemStyle} className={category}></li>
			</Tooltip>

			
		);
	}

	getFirstAndLastDate() {
		let first = moment();
		let last = moment();

		for(let d in this.state.data) {
			let obj = this.state.data[d];
			for(let i in obj) {
				let el = obj[i];
				if(el.start < first) first = el.start;
				if(el.end > last) last = el.end;
			};
		};

		return { 
			first : first, 
			last : last 
		};
	}

	componentWillMount() {
		// Load proper data from database
		let dates = this.getFirstAndLastDate();
		this.setState({ boundaries : dates });
		this.setState({ totalYears : dates.last.year() - dates.first.year()});
	}

	

	componentDidMount() {
		const canvas = this.refs.canvas;
		this.consts.context = canvas.getContext("2d");
		canvas.width = this.consts.tickWidth * 12 * (this.state.totalYears+1);
		canvas.parentElement.scrollLeft = canvas.width;

		this.drawBackground();
		this.drawYears();
		this.drawToday();
	}
	
	render() {
		return (
			<div className="Timeline">
				<Grid>
					<Row>
						<Col xs={12}>
							<ul className="labels">
								<li>Work Life</li>
								<li>Life Events</li>
								<li>Education</li>
							</ul>
							<div className="Wrapper">
								<canvas ref="canvas" width={100} height={120} onClick={this.handleClick}></canvas>
								<ul className="events" ref="events">
									{this.createAllEvents()}
								</ul>
							</div>
						</Col>
					</Row>
				</Grid>
			</div>
		);
	}
}

export default Timeline;