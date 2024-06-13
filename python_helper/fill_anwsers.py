import arrays_N as array_N
import create_answers as create_answers

points = [arrays_N.array_A, arrays_N.array_B, arrays_N.array_C, arrays_N.array_D, arrays_N.array_E,
 arrays_N.array_F, arrays_N.array_G, arrays_N.array_H, arrays_N.array_I, arrays_N.array_J]
for array in points:
    result = create_answers.split_into_triplets(array)
    for triplet in result:
        for idx, number in enumerate(triplet, start=1):
            symbol = ''
            if idx == 1:
                symbol = '+'
            elif idx == 2:
                symbol = 'M'
            elif idx == 3:
                symbol = '-'
            f = open("answers.sql", "a")
            f.write(f"INSERT INTO Answers (answer_text, question_id, points) VALUES ('{symbol}', 1, {number});\n")
            f.close()
        f = open("answers.sql", "a")
        f.write("\n")
        f.close()