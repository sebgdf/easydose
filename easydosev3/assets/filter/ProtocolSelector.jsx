import React, { Component } from 'react';
import { Multiselect } from 'multiselect-react-dropdown';
import { createRoot } from 'react-dom/client';
class ProtocolSelector extends Component {
    constructor(props) {
        super(props);

        // Définition de l'état initial
        this.state = {
            options: [], // Liste de tous les protocoles disponibles pour le Multiselect
            selectedProtocols: [], // Liste des protocoles sélectionnés par l'utilisateur
            loading: true, // Indicateur de chargement
            error: null // Stockage des erreurs éventuelles
        };

        // Lier les méthodes de gestion d'événements à l'instance de la classe
        this.onSelect = this.onSelect.bind(this);
        this.onRemove = this.onRemove.bind(this);
        
        this.API_URL = "/" + jsonprotocolespathname;
    }

    /**
     * Cycle de vie : Exécuté après le montage initial du composant dans le DOM.
     * C'est l'endroit idéal pour les appels API.
     */
    componentDidMount() {
        this.fetchProtocols();
    }

    // Méthode asynchrone pour la récupération des données
    async fetchProtocols() {
        try {
            const response = await fetch(this.API_URL);
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }
            const data = await response.json();
            
            const protocolList = data || []; 
            console.log(protocolList);
            // Formatage des données en objets { name: "...", id: "..." }
            const formattedOptions = protocolList
                .filter(protocol => protocol && protocol.name.trim() !== '' && !protocol.name.startsWith("b'")) 
                .map(protocol => ({ 
                    name: protocol.name.trim(), 
                    id: protocol.name.trim() 
                }));

            // Mise à jour de l'état avec les données récupérées
            this.setState({ 
                options: formattedOptions, 
                loading: false 
            });
            
        } catch (error) {
            console.error("Erreur lors de la récupération des protocoles :", error);
            // Mise à jour de l'état en cas d'erreur
            this.setState({ 
                error: "Impossible de charger les protocoles.", 
                loading: false 
            });
        }
    }

    // Gestionnaire d'événement pour la sélection
    onSelect(selectedList, selectedItem) {
        this.setState({ selectedProtocols: selectedList });
        console.log('Protocoles sélectionnés:', selectedList);
    }

    //<!-- h3 Sélection des Protocoles (Mode Classe) h3 -->
    //{selectedProtocols.length > 0 && (
    //    <!-- p
    //        Vous avez sélectionné : {selectedProtocols.map(p => p.name).join(', ')}
    //    p -->
    //)}
    
    // Gestionnaire d'événement pour la désélection
    onRemove(selectedList, removedItem) {
        this.setState({ selectedProtocols: selectedList });
        console.log('Protocole retiré. Liste actuelle:', selectedList);
    }

    /**
     * Cycle de vie : Rendu du composant
     */
    render() {
        const { options, selectedProtocols, loading, error } = this.state;
        
        if (loading) {
            return <div>Chargement des protocoles...</div>;
        }

        if (error) {
            return <div style={{ color: 'red' }}>Erreur : {error}</div>;
        }

        return (
            <div className="protocol-selector-container">
                
                <Multiselect
                    options={options} 
                    selectedValues={selectedProtocols} 
                    onSelect={this.onSelect} 
                    onRemove={this.onRemove} 
                    displayValue="name" 
                    placeholder="Sélectionnez un ou plusieurs protocoles"
                    showCheckbox={true}
                />

            </div>
        );
    }
}

export default ProtocolSelector;