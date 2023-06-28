import face_recognition
import sys


# Chemins des deux images à comparer

image_path1 = sys.argv[1]
image_path2 = sys.argv[2]
# Charger les images
image1 = face_recognition.load_image_file(image_path1)
image2 = face_recognition.load_image_file(image_path2)

# Extraire les encodages des visages dans les images
face_encodings1 = face_recognition.face_encodings(image1)
face_encodings2 = face_recognition.face_encodings(image2)

# Vérifier s'il y a un visage dans chaque image
if len(face_encodings1) == 0 or len(face_encodings2) == 0:
    print("Pas de visage détecté dans au moins l'une des images.")
else:
    # Sélectionner le premier encodage de visage dans chaque image
    face_encoding1 = face_encodings1[0]
    face_encoding2 = face_encodings2[0]

    # Comparer les encodages des visages et obtenir une liste de booléens indiquant la similarité
    matches = face_recognition.compare_faces([face_encoding1], face_encoding2)

    # Calculer la similarité en pourcentage
    similarity = face_recognition.face_distance([face_encoding1], face_encoding2)[0]
    similarity = round((1 - similarity) * 100, 2)

    # Afficher les résultats
    if matches[0]:
        print("Les visages sont similaires. Similarité :", similarity)
    else:
        print("Les visages sont différents. Similarité :", similarity)
