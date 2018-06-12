import React, { Component } from 'react';
import { Link } from "react-router-dom";
import { Grid, Row, Col } from "react-bootstrap";
import "./Projects.css";

class Projects extends Component {

    listProjects() {
        let projects = [
            {
                name    : "Project 1",
                image   : "http://marcelogaia.com.br/layout/assets/Home_HmgC5Bq.280x170.PNG",
                description : "Simple and short project description. Simple and short project description. Simple and short project description. Simple and short project description."
            },{
                name    : "Project 2",
                image   : "http://marcelogaia.com.br/layout/assets/Home_RqasiXc.280x170.PNG",
                description : "Simple and short project description. Simple and short project description. Simple and short project description. Simple and short project description."
            },{
                name    : "Project 3",
                image   : "http://marcelogaia.com.br/layout/assets/Home_yBu0BCM.280x170.PNG",
                description : "Simple and short project description. Simple and short project description. Simple and short project description. Simple and short project description."
            }
        ];

        let map = projects.map((project,id) => 
            <Col md={4} className="img-view">
                <img src={project.image} alt={project.name} />
                <span className="overlay">
                    <h3>{project.name}</h3>
                    <p>{project.description}</p>
                </span>
            </Col>
        );

        return (
            <Grid>
                <Row>
                    {map}
                </Row>
            </Grid>
        );
    }

	render() {
		return (
		<div className="Projects">
            {this.listProjects()}
            <Link to="#" className="see-all">
                Click to see all projects
            </Link>
		</div>
		);
	}
}

export default Projects;