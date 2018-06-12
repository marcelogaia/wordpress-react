import React, { Component } from 'react';
import './Home.css';
import Section from "../Section";
import Header from "../Header";
import Banner from "./Banner";
import About from "./About";
import Timeline from "./Timeline";
import Skills from "./Skills";
import Projects from "./Projects";

class Home extends Component {
  render() {
    return (
      <div className="Home">
        <Header />
        <Banner />
        <Section title="About me" name="about">
          <About />
          <Timeline />
        </Section>
        
        <Section title="Latest Projects" name="projects" className="gray">
          <Projects />
        </Section>
        
        <Section title="Skills" name="skills">
          <Skills />
        </Section>
        
        <Section title="Testimonials" name="testimonials" className="gray">
        </Section>
        
        <Section title="Keep in touch" name="contact" className="blue">
        </Section>
      </div>
    );
  }
}

export default Home;
