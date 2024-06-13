import arrays_N as array_N
import create_answers as create_answers
import math

def print_numbers_with_percentage(maximum, minimum, specified_number):
    # Вычисляем общее количество чисел
    total_numbers = maximum - minimum
    # Распределение от максимума до минимума
    for num in range(maximum, minimum - 1, -1):
        # Вычисляем процентное значение относительно максимума до определенного числа
        percentage_to_specified = round((num - specified_number) / (maximum - specified_number) * 100)
        
        # Ограничиваем проценты в диапазоне от -100% до 100%
        percentage_to_specified = max(-100, min(percentage_to_specified, 100))
        
        print(f"{num} - {percentage_to_specified}%")
        f = open("percents.js", "a")
        f.write(f"{num} : {percentage_to_specified},\n")
        f.close()


    
f = open ("percents.js", "a")
f.write("let result_value = {\n")
f.write("woman : {,\n")
f.close()

print_numbers_with_percentage(create_answers.max_point(array_N.array_A), create_answers.min_point(array_N.array_A), 86,)
print_numbers_with_percentage(create_answers.max_point(array_N.array_B), create_answers.min_point(array_N.array_B), 98,)
print_numbers_with_percentage(create_answers.max_point(array_N.array_C), create_answers.min_point(array_N.array_C), 90,)
print_numbers_with_percentage(create_answers.max_point(array_N.array_D), create_answers.min_point(array_N.array_D), 72,)
print_numbers_with_percentage(create_answers.max_point(array_N.array_E), create_answers.min_point(array_N.array_E), 72,)
print_numbers_with_percentage(create_answers.max_point(array_N.array_F), create_answers.min_point(array_N.array_F), 71,)
print_numbers_with_percentage(create_answers.max_point(array_N.array_G), create_answers.min_point(array_N.array_G), 98,)
print_numbers_with_percentage(create_answers.max_point(array_N.array_H), create_answers.min_point(array_N.array_H), 103,)
print_numbers_with_percentage(create_answers.max_point(array_N.array_I), create_answers.min_point(array_N.array_I), 87,)
print_numbers_with_percentage(create_answers.max_point(array_N.array_J), create_answers.min_point(array_N.array_J), 96,)

# def print_numbers_with_percentage(maximum, minimum, specified_number):
#     # Вычисляем общее количество чисел
#     total_numbers = maximum - minimum
    
#     # Распределение от максимума до минимума
#     for num in range(maximum, minimum - 1, -1):
#         # Вычисляем процентное значение относительно максимума до определенного числа
#         percentage_to_specified = round((num - specified_number) / (maximum - specified_number) * 100)
        
#         # Ограничиваем проценты в диапазоне от -100% до 100%
#         percentage_to_specified = max(-100, min(percentage_to_specified, 100))
        
#         print(f"{num} - {percentage_to_specified}%")
