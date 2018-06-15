import React, { Component } from 'react';
import { Grid, Row, Col } from "react-bootstrap";
import portrait from './marcelo_portrait.jpg';
import "./About.css";
import ico_github from "./ico_github.png";
import ico_linkedin from "./ico_lkdn.png";
import ico_mail from "./ico_mail.png";

class About extends Component {
	render() {
		const subtitle = "Plan it. Get it done. Make it better.";
		const SocialLinks = (props) => {
			return ( 
			<ul className={props.className}>
				<li><a href="https://github.com/marcelogaia" target="_blank" rel="noopener noreferrer"><img src={ico_github} alt="Github" /></a></li>
				<li><a href="https://www.linkedin.com/in/marcelogaia" target="_blank" rel="noopener noreferrer"><img src={ico_linkedin} alt="LinkedIn" /></a></li>
				<li><a href="mailto:marcelo@marcelogaia.com.br" target="_blank" rel="noopener noreferrer"><img src={ico_mail} alt="Mail" /></a></li>
			</ul>
			);
		}
		
		return (
			<div className="About">
				<Grid>
					<Row>
						<Col xs={12} sm={4}>
							<img src={portrait} alt="Marcelo's portrait" className="portrait" />
						</Col>
						<Col xs={12} sm={8}>
							<h3>{subtitle}</h3>
							<div>
								<p>
									I’m <strong>eager to face new challenges</strong>. Always looking for the best way to solve problems.
								</p>
								<p>
									I am <strong>passionate to learn</strong> new and better ways to <strong>improve myself and my team</strong>.
								</p>
								<p>
									Starting with PHP, I learned some other languages, always seeking to fulfill the necessities of each job.<br />
								</p>
							</div>
							<SocialLinks className="social" />
						</Col>
					</Row>
				</Grid>
			</div>
		);
	}
}

export default About;