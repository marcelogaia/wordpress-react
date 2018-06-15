import React, { Component } from 'react';
import { Link } from "react-router-dom";
import { Grid, Row, Col } from "react-bootstrap";
import "./Projects.css";
import ProjectPage from "./ProjectPage";
import Modal from "react-modal";

Modal.defaultStyles.overlay.zIndex = 11;

class Projects extends Component {

    constructor(props) {
        super(props);
    
        this.state = {
          modalIsOpen: false,
          currentProject: 1
        };
    
        this.openModal = this.openModal.bind(this);
        this.afterOpenModal = this.afterOpenModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
    }

    listProjects() {
        let projects = [
            {
                id      : 1,
                name    : "Project 1",
                image   : "http://marcelogaia.com.br/layout/assets/Home_HmgC5Bq.280x170.PNG",
                description : "Simple and short project description. Simple and short project description. Simple and short project description. Simple and short project description."
            },{
                id      : 2,
                name    : "Project 2",
                image   : "http://marcelogaia.com.br/layout/assets/Home_RqasiXc.280x170.PNG",
                description : "Simple and short project description. Simple and short project description. Simple and short project description. Simple and short project description."
            },{
                id      : 3,
                name    : "Project 3",
                image   : "http://marcelogaia.com.br/layout/assets/Home_yBu0BCM.280x170.PNG",
                description : "Simple and short project description. Simple and short project description. Simple and short project description. Simple and short project description."
            }
        ];

        let map = projects.map((project,id) => 
            <Col md={4} className="img-view" key={id}>
                <img src={project.image} alt={project.name} />
                <span className="overlay" onClick={this.openModal}>
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

    openModal(projectId) {
        this.setState({
            modalIsOpen: true
        });
    }

    afterOpenModal() {
        // references are now sync'd and can be accessed.
        this.refs.page.projectId = this.state.projectId;
    }

    closeModal() {
        this.setState({modalIsOpen: false});
    }

	render() {
        const customStyles = {
            zIndex : 11
        };
        
		return (
            <div className="Projects">
                {this.listProjects()}
                <Link to="#" className="see-all">
                    Click to see all projects
                </Link>
                <Modal isOpen={this.state.modalIsOpen}
                    onAfterOpen={this.afterOpenModal}
                    onRequestClose={this.closeModal}
                    style={customStyles}
                    contentLabel=""
                    appElement={document.getElementById('root')}
                >
                    <button onClick={this.closeModal}>close</button>
                    <ProjectPage ref="page" closeModal={this.closeModal} />
                </Modal>
            </div>
		);
	}
}

export default Projects;