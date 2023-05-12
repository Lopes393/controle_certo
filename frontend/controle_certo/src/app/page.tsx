"use client"; // this is a client component 👈🏽

import React, { useEffect, useState } from "react";
import CustomButtonContact from "./components/CustomButtonContact";
import CustomButtonInfo from "./components/CustomButtonInfo";
import CustomInput from "./components/CustomInput";
import { FaTrash, FaEdit } from "react-icons/fa";
import axios from "axios";
import Swal from "sweetalert2";

type API = {
  id: number;
  name: number;
  cpf: string;
  type: string;
  description: string;
};

export default function Home() {
  const [contacts, setContats] = useState<any>([]);
  const [contact, setContact] = useState<any>({});
  const [searchString, setSearchString] = useState("");
  const [disable, setDisable] = useState(false);

  useEffect(() => {
    getPeaple();
  }, []);

  const handleSearch = (e: any) => {
    setSearchString(e.target.value);
  };
  const filteredContacts = contacts.filter((contact: any) =>
    contact.name.toLowerCase().includes(searchString.toLowerCase())
  );

  async function handleDetail(contactDetail: any) {
    getPeapleById(contactDetail.id);
  }

  async function getPeapleById(id: number) {
    const response = await fetch(`http://localhost:8000/public/index/pessoas/${id}`);
    const data = await response.json();
    setContact(data);
  }

  async function getPeaple() {
    const response = await fetch("http://localhost:8000/public/index/pessoas");
    const data = await response.json();
    setContats(data);
  }

  function handleDeletePeople(id: number) {
    Swal.fire({
      title: "Ao excluir a pessoa, todos os seus contatos serão excluídos, confirmar?",
      showDenyButton: true,
      confirmButtonText: "Sim",
      denyButtonText: "Não",
      customClass: {
        actions: "my-actions",
        confirmButton: "order-2",
        denyButton: "order-3",
      },
    }).then(async (result) => {
      if (result.isConfirmed) {
        const response = await axios.delete(`http://localhost:8000/public/index/pessoas/${id}`);
        if (response.status) {
          Swal.fire("Pessoa e seus contatos excluídos!", "", "success");
        }
        getPeaple();
        setContact({});
      } else if (result.isDenied) {
        Swal.fire("Operação cancelada", "", "info");
      }
    });
  }
  function handleDeleteContato(id: number) {
    Swal.fire({
      title: "Deletar contato?",
      showDenyButton: true,
      confirmButtonText: "Sim",
      denyButtonText: "Não",
      customClass: {
        actions: "my-actions",
        confirmButton: "order-2",
        denyButton: "order-3",
      },
    }).then(async (result) => {
      if (result.isConfirmed) {
        const response = await axios.delete(`http://localhost:8000/public/index/contatos/${id}`);
        getPeapleById(response.data.id_people);
        Swal.fire(response.data.response, "", response.data.status);
      } else if (result.isDenied) {
        Swal.fire("Operação cancelada", "", "info");
      }
    });
  }

  return (
    <main className="flex min-h-screen flex-col items-center justify-between">
      <div className="content">
        <div className="contacts">
          <div className="search">
            <CustomInput
              placeholder="Pesquisar Contatos"
              value={searchString}
              onChange={handleSearch}
              className="input"
            />
          </div>
          <div className="itens">
            {filteredContacts.map((itemContact: any) => (
              <div className="item" key={itemContact.id} onClick={() => handleDetail(itemContact)}>
                <img src="https://i.imgur.com/Y326hv0.png" alt="" />
                {itemContact.name}
              </div>
            ))}
          </div>
          <CustomButtonInfo
            className="custom-button-save-people"
            text="+"
            variant="primary"
            disable={disable}
            setDisable={setDisable}
            setContacts={getPeaple}
            setDetail={setContact}
          />
        </div>
        {contact.id ? (
          <div className="detail">
            <div className="card">
              <div className="contact">
                <img src="https://i.imgur.com/Y326hv0.png" alt="" />
                <h2>{contact?.name}</h2>
                <div className="buttons">
                  <CustomButtonInfo
                    disable={disable}
                    setDisable={setDisable}
                    setDetail={getPeapleById}
                    setContacts={getPeaple}
                    data={contact}
                  />
                  <button onClick={() => handleDeletePeople(contact.id)}>
                    <FaTrash />
                  </button>
                </div>
              </div>
              <p className="cpf">CPF: {contact?.cpf}</p>
              <hr />
              {contact?.contatos?.map((contato: any) => (
                <div className="contact-description">
                  <p className="phone-number">{contato?.type}</p>
                  <p className="description">{contato.description}</p>
                  <div className="buttons">
                    <CustomButtonContact
                      disable={disable}
                      setDisable={setDisable}
                      setDetail={getPeapleById}
                      idPessoa={contact.id}
                      data={contato}
                    />

                    <button onClick={() => handleDeleteContato(contato.id)}>
                      <FaTrash />
                    </button>
                  </div>
                </div>
              ))}
            </div>
            <CustomButtonContact
              className="custom-button-save-contact"
              text="+"
              variant="primary"
              disable={disable}
              setDisable={setDisable}
              setDetail={getPeapleById}
              idPessoa={contact.id}
            />
          </div>
        ) : (
          <></>
        )}
      </div>
    </main>
  );
}
