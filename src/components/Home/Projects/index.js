import React, { Component } from 'react';
import { Link } from "react-router-dom";
import { Grid, Row, Col } from "react-bootstrap";
import "./Projects.css";
import ProjectPage from "./ProjectPage";
import Modal from "react-modal";
import axios from "axios";

Modal.defaultStyles.overlay.zIndex = 11;
Modal.defaultStyles.overlay.background = "rgba(0,0,0,0.8)";

class Projects extends Component {

    constructor(props) {
        super(props);
    
        this.state = {
          modalIsOpen: false,
          currentProject: 1,
          projects: []
        };
    
        this.openModal = this.openModal.bind(this);
        this.afterOpenModal = this.afterOpenModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
    }

    componentDidMount() {
        axios.get("http://marcelogaia.com.br/blog/wp-json/wp/v2/jetpack-portfolio?_embed")
        .then(response => {
            const projects = response.data.slice(0, 6).map(p => {
                let imageInfo = p._embedded["wp:featuredmedia"],
                    image = "";

                if (imageInfo !== undefined) {
                    image = imageInfo[0].media_details.sizes.marcelogaia_project_thumb.source_url;
                }
                
                return {
                    id : p.id,
                    name : p.title.rendered,
                    image : image,
                    description : "Simple and short project description. Simple and short project description. Simple and short project description. Simple and short project description."
                };
            });

            this.setState({projects : projects});
        }).catch(error => console.log(error));
    }

    listProjects() {
        let map = this.state.projects.map((p,i) => 
            <Col md={4} className="img-view" key={i}>
                <img src={`${p.image}?resize=3602C225`} alt={p.name} />
                <span className="overlay" onClick={() => this.openModal(p.id)}>
                    <h3>{p.name}</h3>
                    <p>{p.description}</p>
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
            modalIsOpen: true,
            currentProject: projectId
        });
    }

    afterOpenModal() {
        // references are now sync'd and can be accessed.
        this.refs.page.setState({
            projectId : this.state.currentProject
        })
    }

    closeModal() {
        this.setState({modalIsOpen: false});
    }

	render() {
        
        const customStyles = {};

		return (
            <div className="Projects">
                {this.listProjects()}
                <Link to="#" className="see-all">
                    Click to see all projects
                </Link>
                <Modal isOpen={this.state.modalIsOpen}
                    onAfterOpen={this.afterOpenModal}
                    onRequestClose={this.closeModal}
                    contentLabel="test"
                    style={customStyles}
                    appElement={document.getElementById('root')}
                >
                    <ProjectPage ref="page" closeModal={this.closeModal} />
                </Modal>
            </div>
		);
	}
}

export default Projects;