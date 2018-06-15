import React, { Component } from "react";
import "./ProjectPage.css";

class ProjectPage extends Component {
    constructor(props) {
        super(props);

        this.state = {
            projectId : props.projectId
        };
    }
    
    componentDidMount() {
    }

    render () {
        return (
            <div className="ProjectPage">
                <div className="info">
                    {this.state.projectId}
                    <span className="closeBtn" onClick={this.props.closeModal}></span>
                </div>
            </div>
        )
    }
}

export default ProjectPage